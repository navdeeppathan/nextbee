<?php

namespace App\Http\Controllers;

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

   public function createContact()
    {
        $token = $this->getValidAccessToken();
        $xero = XeroToken::where('user_id', auth()->id())->first();

        $response = Http::withToken($token)
            ->withHeaders([
                'xero-tenant-id' => $xero->tenant_id,
            ])
            ->post('https://api.xero.com/api.xro/2.0/Contacts', [
                'Name' => 'Customer Name',
                'EmailAddress' => 'customer@gmail.com',
            ]);

        return $response->json();
    }

    public function createInvoice()
    {
        $token = $this->getValidAccessToken();
        $xero = XeroToken::where('user_id', auth()->id())->first();

        $response = Http::withToken($token)
            ->withHeaders([
                'xero-tenant-id' => $xero->tenant_id,
            ])
            ->post('https://api.xero.com/api.xro/2.0/Invoices', [
                "Invoices" => [
                    [
                        "Type" => "ACCREC",
                        "Contact" => [
                            "Name" => "Customer Name"
                        ],
                        "LineItems" => [
                            [
                                "Description" => "Product",
                                "Quantity" => 1,
                                "UnitAmount" => 100,
                                "AccountCode" => "200"
                            ]
                        ],
                        "Status" => "DRAFT"
                    ]
                ]
            ]);

        return $response->json();
    }
}
