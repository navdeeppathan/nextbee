<?php

namespace App\Http\Controllers;

use App\Mail\SendPriceList;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\callback;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
            'business_name'=>'required',
            'phone'=>'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'customer',
        ]);

        // ❌ remove Auth::login($user);
        // ✅ direct login page
        return redirect('/login')->with('success', 'Register success, please login');
    }

    public function registerDriver(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone'=>'required',
            'licence_no'=>'required',
            'licence_expiry'=>'required',
            'assigned_vehicle'=>'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' =>'driver',
            'phone'=>$request->phone,
            'licence_no'=>$request->licence_no,
            'licence_expiry'=>$request->licence_expiry,
            'assigned_vehicle'=>$request->assigned_vehicle,
            'password' => Hash::make('123456'),

        ]);

        // ❌ remove Auth::login($user);
        // ✅ direct login page
        return redirect()->back()->with('success', 'Register success, please login');
    }

    public function registerCustomer(Request $request)
    {
        $request->validate([
            'business_name' => 'required',
            'name' => 'nullable',
            'email' => 'required|email|unique:users',
            'business_type'=>'nullable',
            'delivery_address'=>'nullable',
            'primary_contact_name'=>'nullable',
            'preferred_delivery_days' => 'nullable|array',
            'phone'=>'nullable',
            'monthly_volume'=>'nullable',
            'sales_assigned'=>'nullable',
            'credit_limit' => 'nullable',
            'invoice_pay_days' => 'nullable',
            'tier' => 'nullable',
        ]);

        $user = User::create([
            'name' => $request->name ?? $request->business_name,
            'email' => $request->email,
            'role' =>'customer',
            'phone'=>$request->phone,
            'business_name'=>$request->business_name,
            'business_type'=>$request->business_type,
            'delivery_address'=>$request->delivery_address,
            'primary_contact_name'=>$request->primary_contact_name,
            'preferred_delivery_days'=>$request->preferred_delivery_days,
            'monthly_volume'=>$request->monthly_volume,
             // ✅ DEFAULT PASSWORD
            'password' => Hash::make('123456'),
            'sales_assigned'=>$request->sales_assigned,
            'credit_limit'=>$request->credit_limit,
            'invoice_pay_days'=>$request->invoice_pay_days,
            'tier'=>$request->tier,
            'status'=>'pending'
        ]);

        // ✅ CALL XERO API
        try {
            $xero = new XeroController();

            $response = $xero->createContact(
                $user->business_name,
                $user->email
            );

            

            // OPTIONAL: store xero contact id
            if (isset($response['Contacts'][0]['ContactID'])) {
                $user->update([
                    'xero_contact_id' => $response['Contacts'][0]['ContactID']
                ]);
            }

        } catch (\Exception $e) {
            
            \Log::error('Xero Contact Error: ' . $e->getMessage());
        }

        //  remove Auth::login($user);
        // direct login page
        return redirect()->back()->with('success', 'Register success, please login');
    }

    public function updateCustomer(Request $request, $id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);

        $request->validate([
            'business_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'business_type' => 'nullable',
            'delivery_address' => 'nullable',
            'primary_contact_name' => 'nullable',
            'preferred_delivery_days' => 'nullable|array',
            'phone' => 'nullable',
            'monthly_volume' => 'nullable',
            'sales_assigned' => 'nullable',
            'credit_limit' => 'nullable',
            'invoice_pay_days' => 'nullable',
            'tier' => 'nullable',
            'status' => 'nullable',
            
        ]);

        $customer->update([
            'name' => $request->name ?? $request->business_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'delivery_address' => $request->delivery_address,
            'primary_contact_name' => $request->primary_contact_name,

            // 🔥 IMPORTANT (store as JSON)
            'preferred_delivery_days' => $request->preferred_delivery_days ?? [],

            'monthly_volume' => $request->monthly_volume,
            'sales_assigned' => $request->sales_assigned,
            'credit_limit' => $request->credit_limit,
            'invoice_pay_days' => $request->invoice_pay_days,
            'tier' => $request->tier,

            // optional
            'status' => $request->status ?? $customer->status,
            
        ]);

        return redirect()->back()->with('success', 'Customer updated successfully ✅');
    }
    

    
    // LOGIN
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // ONLY customer goes to frontend
            if (trim($user->role) == 'customer') {
                return redirect('/main');
            }
            if (trim($user->role) == 'business_owner') {
                return redirect('/main');
            }
            if (trim($user->role) == 'sale_rep') {
                return redirect('/sales');
                
            }
            if (trim($user->role) == 'inventory_manager') {
                return redirect('/inventory-page');
                
            }

            if(trim($user->role) == 'delivery_team') {
                return redirect('/delivery');
            }
            if(trim($user->role) == 'driver') {
                return redirect('/driver-orders');
            
            }
             if(trim($user->role) == 'superadmin') {
                return redirect('/dashboard');
            }

            // all other roles go to admin
            // return redirect('/admin-dashboard');
            return redirect('/main');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // LOGOUT
    public function logout()
    {
      
        Auth::logout();
        return redirect('/');
    }

    // PROFILE
    public function profile()
    {
        return view('auth.profile');
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Profile updated ✅');
    }

    public function updateAddress(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'delivery_address' => $request->delivery_address
        ]);

        return back()->with('success', 'Address updated ✅');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = auth()->user();

        $user->update([
            'password' => \Hash::make($request->password)
        ]);

        return back()->with('success', 'Password changed ✅');
    }

   public function sendPriceList(Request $request, $id)
    {
        $request->validate([
            'pricelist' => 'required|file|mimes:pdf,xlsx,csv|max:2048'
        ]);

        $customer = User::findOrFail($id);

        // 📁 File name generate
        $fileName = time() . '_' . $request->file('pricelist')->getClientOriginalName();

        // 📁 Move to public/pricelists
        $request->file('pricelist')->move(public_path('pricelists'), $fileName);

        $filePath = public_path('pricelists/' . $fileName);

        // 📧 Send email with attachment
        Mail::to($customer->email)
            ->send(new SendPriceList($customer, $filePath));

        return back()->with('success', 'Price list uploaded & sent successfully!');
    }


    public function showCustomer($id)
    {
        $customer = User::where('role', 'customer')
            ->whereNotNull('business_name')
            ->findOrFail($id);
        
        $orders = Order::with(['items', 'payment'])
            ->where('user_id', $customer->id)
            ->latest()
            ->get();

        
        $months = 1;
        $recentOrders = $orders->where('created_at', '>=', now()->subMonths($months));
        $monthlyAverageOrder = $months > 0 ? round($recentOrders->count() / $months, 1) : 0;
        $orderFrequency = $orders->count();
        $lastOrder = $orders->first();

        return view('SalesRep.showcustomer', compact(
            'customer',
            'orders',
            'monthlyAverageOrder',
            'orderFrequency',
            'lastOrder'
        ));
    }

    public function updateSalesAssign(Request $request, $id)
    {
        

        $request->validate([
            'sales_assigned' => 'required|exists:users,id'
        ]);

        $customer = User::where('role', 'customer')->findOrFail($id);

        // ✅ Update only this field
        $customer->update([
            'sales_assigned' => $request->sales_assigned
        ]);

        return back()->with('success', 'Sales representative updated successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!in_array($request->status, ['blocked', 'suspended', 'active'])) {
            return back()->with('error', 'Invalid status');
        }

        $user->status = $request->status;
        $user->save();

        return back()->with('success', 'User status updated successfully');
    }
    
}
