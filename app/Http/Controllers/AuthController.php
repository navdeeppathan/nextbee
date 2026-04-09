<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'assigned_vehicle'=>$request->assigned_vehicle
        ]);

        // ❌ remove Auth::login($user);
        // ✅ direct login page
        return redirect()->back()->with('success', 'Register success, please login');
    }

    public function registerCustomer(Request $request)
    {
        $request->validate([
            'business_name' => 'required',
            'email' => 'required|email|unique:users',
            'business_type'=>'required',
            'delivery_address'=>'required',
            'primary_contact_name'=>'required',
            'preferred_delivery_days' => 'required|array',
            'phone'=>'required',
            'monthly_volume'=>'required',
        ]);

        User::create([
            'name' => $request->business_name,
            'email' => $request->email,
            'role' =>'customer',
            'phone'=>$request->phone,
            'business_name'=>$request->business_name,
            'business_type'=>$request->business_type,
            'delivery_address'=>$request->delivery_address,
            'primary_contact_name'=>$request->primary_contact_name,
            'preferred_delivery_days'=>$request->preferred_delivery_days,
            'monthly_volume'=>$request->monthly_volume
        ]);

        // ❌ remove Auth::login($user);
        // ✅ direct login page
        return redirect()->back()->with('success', 'Register success, please login');
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
                return redirect('/inventory');
                
            }

            if(trim($user->role) == 'delivery_team') {
                return redirect('/delivery');
            
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
    
}
