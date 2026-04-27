<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\XeroToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class XeroController extends Controller
{

   public function connect()
    {
        $clientId = env('XERO_CLIENT_ID');
        $redirectUri = urlencode(env('XERO_REDIRECT_URI'));

        $scope = urlencode(
            'offline_access accounting.settings accounting.contacts accounting.invoices'
        );

        return redirect(
            "https://login.xero.com/identity/connect/authorize?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}&scope={$scope}"
        );
    }

    public function callback(Request $request)
    {
        $code = $request->query('code');

        $response = Http::asForm()
            ->withBasicAuth(env('XERO_CLIENT_ID'), env('XERO_CLIENT_SECRET'))
            ->post('https://identity.xero.com/connect/token', [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('XERO_REDIRECT_URI'),
            ]);

        $data = $response->json();

        XeroToken::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'access_token' => $data['access_token'],
                'refresh_token' => $data['refresh_token'],
                'expires_at' => now()->addSeconds($data['expires_in']),
            ]
        );

        return redirect('/xero/tenant');
    }

    public function getTenant()
    {
        $token = $this->getValidAccessToken();

        $response = Http::withToken($token)
            ->get('https://api.xero.com/connections');

        $data = $response->json();

        XeroToken::where('user_id', auth()->id())
            ->update([
                'tenant_id' => $data[0]['tenantId'] ?? null
            ]);

        return redirect('/dashboard');
    }

    

    private function getValidAccessToken()
    {
        $token = XeroToken::where('user_id', auth()->id())->first();

        if (!$token) {
            throw new \Exception("Xero not connected");
        }

        if (now()->greaterThan($token->expires_at)) {
            return $this->refreshToken($token);
        }

        return $token->access_token;
    }

    private function refreshToken($token)
    {
        $response = Http::asForm()
            ->withBasicAuth(env('XERO_CLIENT_ID'), env('XERO_CLIENT_SECRET'))
            ->post('https://identity.xero.com/connect/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $token->refresh_token,
            ]);

        $data = $response->json();

        $token->update([
            'access_token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'expires_at' => now()->addSeconds($data['expires_in']),
        ]);

        return $data['access_token'];
    }

    public function createContact($name, $email)
    {
        // ✅ Always use superadmin token
        $xero = XeroToken::first(); // or where role = superadmin

        if (!$xero) {
            throw new \Exception("Xero not connected");
        }

        $token = $this->getValidAccessTokenByToken($xero);

        $response = Http::withToken($token)
            ->withHeaders([
                'xero-tenant-id' => $xero->tenant_id,
            ])
            ->post('https://api.xero.com/api.xro/2.0/Contacts', [
                "Contacts" => [
                    [
                        'Name' => $name,
                        'EmailAddress' => $email,
                    ]
                ]
            ]);

        return $response->json();
    }

    

    public function syncToXero($id)
    {
        try {
            // ✅ Fetch customer with role = customer
            $customer = User::where('id', $id)
                ->where('role', 'customer')
                ->firstOrFail();

            // ✅ Call Xero
            $xero = new XeroController();

            $response = $xero->createContact(
                $customer->business_name,
                $customer->email
            );

            // ✅ Save Xero Contact ID
            if (isset($response['Contacts'][0]['ContactID'])) {
                $customer->update([
                    'xero_contact_id' => $response['Contacts'][0]['ContactID']
                ]);
            }

            return back()->with('success', 'Customer synced to Xero successfully');

        } catch (\Exception $e) {
            \Log::error('Xero Contact Error: ' . $e->getMessage());

            return back()->with('error', 'Failed to sync with Xero');
        }
    }

    

    public function createItem($product)
    {
        // ✅ Always get stored token
        $xero = XeroToken::first();

        if (!$xero) {
            throw new \Exception("Xero not connected");
        }

        // ✅ Use refresh logic
        $accessToken = $this->getValidAccessTokenByToken($xero);

        $response = Http::withToken($accessToken)
            ->withHeaders([
                'xero-tenant-id' => $xero->tenant_id,
                'Accept' => 'application/json',
            ])
            ->post('https://api.xero.com/api.xro/2.0/Items', [
                "Items" => [
                    [
                        "Code" => $product->sku_code ?? 'ITEM-' . $product->id,
                        "Name" => $product->title,
                        "Description" => $product->description ?? '',
                        "PurchaseDescription" => $product->description ?? '',
                        "PurchaseDetails" => [
                            "UnitPrice" => $product->price ?? 0,
                            "AccountCode" => "200"
                        ],
                        "SalesDetails" => [
                            "UnitPrice" => $product->price ?? 0,
                            "AccountCode" => "200"
                        ]
                    ]
                ]
            ]);

        // ✅ Better error logging
        if ($response->failed()) {
            \Log::error('Xero Item Error', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            throw new \Exception('Xero Item Creation Failed');
        }

        return $response->json();
    }

    private function getValidAccessTokenByToken($token)
    {
        if (now()->greaterThan($token->expires_at)) {
            return $this->refreshToken($token);
        }

        return $token->access_token;
    }

    // public function createInvoice($contactId)
    // {
    //     $xero = XeroToken::first();

    //     if (!$xero) {
    //         throw new \Exception("Xero not connected");
    //     }

    //     $token = $this->getValidAccessTokenByToken($xero);

    //     $response = Http::withToken($token)
    //         ->withHeaders([
    //             'xero-tenant-id' => $xero->tenant_id,
    //         ])
    //         ->post('https://api.xero.com/api.xro/2.0/Invoices', [
    //             "Invoices" => [
    //                 [
    //                     "Type" => "ACCREC",
    //                     "Contact" => [
    //                         "ContactID" => $contactId
    //                     ],
    //                     "LineItems" => [
    //                         [
    //                             "Description" => "Product",
    //                             "Quantity" => 1,
    //                             "UnitAmount" => 100,
    //                             "AccountCode" => "200"
    //                         ]
    //                     ],
    //                     "Status" => "DRAFT"
    //                 ]
    //             ]
    //         ]);

    //     return $response->json();
    // }

    public function createInvoice($customer, $order)
    {
        $xero = XeroToken::first();

        if (!$xero) {
            throw new \Exception("Xero not connected");
        }

        $token = $this->getValidAccessTokenByToken($xero);

        $lineItems = [];

        foreach ($order->items as $item) {
            $lineItems[] = [
                "Description" => $item->product->title,
                "Quantity" => $item->quantity,
                "UnitAmount" => $item->price,
                "AccountCode" => "200",
                "DiscountRate" => 0 // or calculate if needed
            ];
        }

        $payload = [
            "Invoices" => [
                [
                    "Type" => "ACCREC",
                    "Contact" => [
                        "ContactID" => $customer->xero_contact_id
                    ],
                    "Date" => now()->format('Y-m-d'),
                    "DueDate" => now()->addDays(7)->format('Y-m-d'),
                    "LineAmountTypes" => "Exclusive",
                    "LineItems" => $lineItems,
                    "Status" => "DRAFT"
                ]
            ]
        ];

        $response = Http::withToken($token)
            ->withHeaders([
                'xero-tenant-id' => $xero->tenant_id,
                'Accept' => 'application/json'
            ])
            ->post('https://api.xero.com/api.xro/2.0/Invoices', $payload);

        if ($response->failed()) {
            \Log::error('Xero Invoice Error', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            throw new \Exception('Invoice creation failed');
        }

        return $response->json();
    }
}
