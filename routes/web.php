<?php

use App\Http\Controllers\AuthController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', function () {
    return view('landing.index');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register-driver', [AuthController::class, 'registerDriver'])->name('register-driver');
Route::post('/register-customer', [AuthController::class, 'registerCustomer'])->name('register-customer');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

Route::post('/admin/products/store', [ProductController::class, 'store'])->name('products.store');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::get('/', function () {
    $categories = Category::all();
    $products = Product::all();
    return view('landing.index', compact('categories', 'products'));
});

Route::get('/main', function () {
    $categories = Category::all();
    $products = Product::all();
    return view('landing.main', compact('categories', 'products'));
});

Route::get('/inventory', function () {
     
    return view('Inventory.layouts.app');
});

Route::get('/inventory/dashboard', function () {
    $totalSkus = Product::count();
    $categories = Category::count();
    $expiringsoon = Product::where('shelf_life' , '<', 3)->count();
    $lowstock = Product::where('quantity' , '<', 10)->count();

    

    $criticalExpiry = Product::all()->filter(function ($product) {

        $expiry = Carbon::parse($product->created_at)
                    ->addDays($product->shelf_life);

        return $expiry->between(now(), now()->addDays(8));
    });

    return view('Inventory.index', compact('totalSkus', 'categories', 'expiringsoon', 'lowstock', 'criticalExpiry'));
});

Route::get('/sales', function () {
    return view('SalesRep.sales_dashboard');
});


Route::get('/customers', function () {
    $customers = User::where('role', 'customer')->whereNotNull('business_name')->get();
    $totalCustomers = User::where('role', 'customer')->whereNotNull('business_name')->count();
    $activeCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'active')->count();
    $inactiveCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'inactive')->count();
    $pendingCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'pending')->count();
    $churnRiskCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'churn_risk')->count();
    return view('inventory.customers', compact('customers', 'totalCustomers', 'activeCustomers', 'inactiveCustomers', 'pendingCustomers', 'churnRiskCustomers'));
});

Route::get('/deliveries', function () {
    return view('inventory.deliveries');
});

Route::get('/drivers', function () {
    $drivers = User::where('role', 'driver')->get();
    $totalDrivers = User::where('role', 'driver')->count();
    return view('inventory.drivers', compact('drivers', 'totalDrivers'));
});

Route::get('/inventory-page', function () {
    $categories = Category::all();
    $products = Product::all();

    return view('inventory.inventory', compact('categories', 'products'));
});

Route::get('/returns', function () {
    return view('inventory.returns');
});

Route::get('/sales-dashboard', function () {
    return view('inventory.sales_dashboard');
});

Route::get('/sales-order', function () {
    return view('inventory.sales_order_detail');
});

Route::get('/sales-order-page', function () {
    return view('inventory.sales_order_page');
});

Route::get('/sales-orders', function () {
    return view('inventory.sales_orders');
});


//sales folder
Route::get('/sales-commissions', function () {
    return view('SalesRep.sales_commissions');
});

Route::get('/sales-customer_detail', function () {
    return view('SalesRep.sales_customer_detail');
});

Route::get('/sales-customers', function () {
    return view('SalesRep.sales_customers');
});


Route::get('/sales-order-detail', function () {
    return view('SalesRep.sales_order_detail');
});

Route::get('/sales-order-page2', function () {
    return view('SalesRep.sales_order_page');
});

Route::get('/sales-orders2', function () {
    return view('SalesRep.sales_orders');
});

Route::get('/sales-performance', function () {
    return view('SalesRep.sales_performance');
});

Route::get('/sales-target', function () {
    return view('SalesRep.sales_targets');
});

Route::get('/sales-tasks', function () {
    return view('SalesRep.sales_tasks');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
})->middleware('auth');

Route::get('/customer/profile', function () {
    return view('customer.profile');
})->middleware('auth');

Route::get('/customer/orders', function () {
    return view('customer.orders');
})->middleware('auth');

Route::get('/customer/payments', function () {
    return view('customer.payments');
})->middleware('auth');