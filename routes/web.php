<?php

use App\Http\Controllers\AuthController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RouteController;


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register-driver', [AuthController::class, 'registerDriver'])->name('register-driver');
Route::post('/register-customer', [AuthController::class, 'registerCustomer'])->name('register-customer');
Route::put('/customer/{id}/update', [AuthController::class, 'updateCustomer'])
    ->name('customer.update');
Route::post('/user/{id}/status', [AuthController::class, 'updateStatus'])
    ->name('user.updateStatus');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Models\Product;

use App\Models\User;
use Carbon\Carbon;

use App\Models\Payment;

// web.php
Route::put('/orderdata/{id}/update-notes', [OrderController::class, 'updateNotes'])
    ->name('order.updateNotes');


Route::get('/login', function () {



    $categories = Category::all();
    $products = Product::with('category')->get(); // 👈 important
    $brands = Product::whereNotNull('brand')
        ->where('brand', '!=', '')
        ->distinct()
        ->pluck('brand');
    return view('Landing.index', compact('categories', 'products', 'brands'));
});

Route::post('/admin/products/store', [ProductController::class, 'store'])->name('products.store');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');


Route::post('/send-pricelist/{id}', [AuthController::class, 'sendPriceList'])
    ->name('send.pricelist');

use App\Http\Controllers\LocationController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderLog;
use App\Models\Cart;

Route::post('/locations/store', [LocationController::class, 'store'])
    ->name('locations.store');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/main'); // ✅ LOGIN HAI → MAIN
    }


    $categories = Category::all();
    $products = Product::with('category')->get(); // 👈 important
    $brands = Product::whereNotNull('brand')
        ->where('brand', '!=', '')
        ->distinct()
        ->pluck('brand');
    return view('Landing.index', compact('categories', 'products', 'brands'));
});

Route::get('/main', function () {
    $categories = Category::all();
    $products = Product::with('category')->get(); // 👈 important
    // 🔥 unique brands nikalo
    $brands = Product::whereNotNull('brand')
        ->where('brand', '!=', '')
        ->distinct()
        ->pluck('brand');
    return view('Landing.main', compact('categories', 'products', 'brands'));
})->middleware('auth');

Route::get('/brand/{brand}', function ($brand) {

    $brand = urldecode($brand);

    // ✅ ALL PRODUCTS (IMPORTANT)
    $products = Product::with('category')->get();

    // ✅ selected brand alag se
    $brandProducts = Product::where('brand', $brand)->pluck('id')->toArray();

    $categories = Category::all();

    $brands = Product::whereNotNull('brand')
        ->where('brand', '!=', '')
        ->distinct()
        ->pluck('brand');

    return view('Landing.productbrand', compact(
        'products',
        'brandProducts',
        'brand',
        'categories',
        'brands'
    ));
});

Route::get('/brands/{brand}', function ($brand) {

    $brand = urldecode($brand);

    // ✅ ALL PRODUCTS (IMPORTANT)
    $products = Product::with('category')->get();

    // ✅ selected brand alag se
    $brandProducts = Product::where('brand', $brand)->pluck('id')->toArray();

    $categories = Category::all();

    $brands = Product::whereNotNull('brand')
        ->where('brand', '!=', '')
        ->distinct()
        ->pluck('brand');
    return view('Landing.brand', compact('products', 'brandProducts', 'brand', 'categories', 'brands'));
});

Route::middleware(['auth', 'role:inventory_manager'])->group(function () {

    Route::get('/inventory', function () {

        return view('Inventory.layouts.app');
    });

    Route::get('/inventory/dashboard', function () {

        $totalSkus = Product::count();
        $categories = Category::count();
        $expiringsoon = Product::where('shelf_life', '<', 3)->count();
        $lowstock = Product::where('quantity', '<', 10)->count();
        $criticalExpiry = Product::all()->filter(function ($product) {

            $expiry = Carbon::parse($product->created_at)
                ->addDays($product->shelf_life);

            return $expiry->between(now(), now()->addDays(8));
        });

        return view('Inventory.index', compact('totalSkus', 'categories', 'expiringsoon', 'lowstock', 'criticalExpiry'));

    });

    Route::get('/customers', function () {
        $customers = User::where('role', 'customer')->whereNotNull('business_name')->get();
        $totalCustomers = User::where('role', 'customer')->whereNotNull('business_name')->count();
        $activeCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'active')->count();
        $inactiveCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'inactive')->count();
        $pendingCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'pending')->count();
        $churnRiskCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'churn_risk')->count();

        return view('Inventory.customers', compact('customers', 'totalCustomers', 'activeCustomers', 'inactiveCustomers', 'pendingCustomers', 'churnRiskCustomers'));
    });

    Route::get('/deliveries', [RouteController::class, 'index']);
    Route::post('/routes', [RouteController::class, 'store']);
    Route::get('/routes/{id}', [RouteController::class, 'show']);
    Route::put('/routes/{id}', [RouteController::class, 'update']);
    Route::delete('/routes/{id}', [RouteController::class, 'destroy']);

    // Route::get('/deliveries', function () {
    //     return view('Inventory.deliveries');
    // });

    Route::get('/drivers', function () {
        $drivers = User::where('role', 'driver')->get();
        $totalDrivers = User::where('role', 'driver')->count();
        return view('Inventory.drivers', compact('drivers', 'totalDrivers'));
    });

    Route::get('/inventory-page', function () {
        $categories = Category::all();
        $products = Product::all();

        return view('Inventory.inventory', compact('categories', 'products'));
    });

    Route::get('/returns', function () {
        return view('Inventory.returns');
    });

    Route::get('/sales-dashboard', function () {
        return view('Inventory.sales_dashboard');
    });

    Route::get('/sales-order', function () {
        return view('Inventory.sales_order_detail');
    });

    Route::get('/sales-order-page', function () {
        return view('Inventory.sales_order_page');
    });

    Route::get('/sales-orders', function () {
        return view('Inventory.sales_orders');
    });

    Route::get('/sales-orders-inventory', function () {
        $orders = Order::with(['user', 'payment'])
        ->where('status', '!=', 'draft')
        ->where('status', '!=', 'created')
        ->where('is_active', 1)
        ->latest()
        ->paginate(10);
        
        $totalOrders = Order::where('status', 'accepted')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('is_active', 1)
            ->count();

        $confirmedOrders = Order::where('status', 'accepted')->where('is_active', 1)->count();    
       
        $processingOrders = Order::where('status', 'ready for delivery')->where('is_active', 1)->count();

        $deliveredOrders = Order::where('status', 'delivered')->where('is_active', 1)->count();
        



        return view('Inventory.inventory_sales_orders', compact('orders', 'totalOrders', 'processingOrders', 'deliveredOrders', 'confirmedOrders'));
    });


});

Route::get('/product-locations/{productId}', function ($productId) {
    return \App\Models\Location::where('product_id', $productId)->get();
});

Route::post('/location/update-qty', function (\Illuminate\Http\Request $req) {
    $location = \App\Models\Location::find($req->location_id);

    if (!$location)
        return response()->json(['error' => 'Not found']);

    if ($req->used_qty > $location->quantity) {
        return response()->json(['error' => 'Not enough stock', 'stock' => $location->quantity, 'used' => $req->used_qty]);
    }

    $location->quantity -= $req->used_qty;
    $location->save();

    return response()->json(['success' => true]);
});

Route::get('/order/logs/{order_id}', function ($order_id) {

    $logs = \App\Models\OrderLog::where('order_id', $order_id)
        ->latest()
        ->with('user') // optional if relation
        ->get();

    return response()->json($logs);
});

//sales folder

Route::middleware(['auth', 'role:sale_rep'])->group(function () {
    Route::get('/sales-commissions', function () {
        return view('SalesRep.sales_commissions');
    });

    Route::get('/sales-customer_detail', function () {
        return view('SalesRep.sales_customer_detail');
    });

    Route::get('/sales-customers', function () {
        $customers = User::with('orders')->where('role', 'customer')->whereNotNull('business_name')->get();
        $totalCustomers = User::where('role', 'customer')->whereNotNull('business_name')->count();
        $activeCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'active')->count();
        $inactiveCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'inactive')->count();
        $pendingCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'pending')->count();
        $blockedCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'blocked')->count();
        $suspendedCustomers = User::where('role', 'customer')->whereNotNull('business_name')->where('status', 'suspended')->count();


        return view('SalesRep.sales_customers', compact('customers', 'totalCustomers', 'activeCustomers', 'inactiveCustomers', 'pendingCustomers', 'blockedCustomers', 'suspendedCustomers'));
    });

    Route::get('/sales/customers/{id}', [AuthController::class, 'showCustomer'])->name('customers.show');
    Route::post('/customer/{id}/assign-sales', [AuthController::class, 'updateSalesAssign'])
        ->name('customer.assign.sales');

    Route::get('/sales-order-detail', function () {
        return view('SalesRep.sales_order_detail');
    });

    Route::get('/sales-tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);



    Route::get('/sales-order-page2', function () {
        return view('SalesRep.sales_order_page');
    });

    Route::get('/sales-orders2', function () {


        $orders= Order::with(['user', 'payment'])->where('status', '!=', 'draft')->where('is_active', 1)->latest()->paginate(10);

        $totalOrders = Order::where('status', 'accepted')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $confirmedOrders = Order::where('status', 'accepted')->count();
        $pendingOrders = Order::where('status', 'created')->count();
        $processingOrders = Order::where('status', 'ready for delivery')->count();

        $deliveredOrders = Order::where('status', 'delivered')->count();

        return view('SalesRep.sales_orders', compact('orders', 'totalOrders', 'pendingOrders', 'processingOrders', 'deliveredOrders', 'confirmedOrders'));
    });

    Route::get('/sales', function () {
        return view('SalesRep.sales_dashboard');
    });

    Route::get('/sales-performance', function () {
        return view('SalesRep.sales_performance');
    });

    Route::get('/sales-target', function () {
        return view('SalesRep.sales_targets');
    });

});


Route::get('/driver-orders', function () {
    $orders = Order::with(['user', 'payment'])
        ->whereNotIn('status', ['confirm', 'pending'])
        ->get();
    $totalOrders = Order::where('status', 'confirm')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();
    $confirmedOrders = Order::where('status', 'confirm')->count();
    $pendingOrders = Order::where('status', 'pending')->count();
    $processingOrders = Order::where('status', 'processing')->count();
    $deliveredOrders = Order::where('status', 'delivered')->count();

    return view('drivers.index', compact('orders', 'totalOrders', 'pendingOrders', 'processingOrders', 'deliveredOrders', 'confirmedOrders'));
});




// Route::get('/sales-tasks', function () {
//     return view('SalesRep.sales_tasks');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/customer/dashboard', [OrderController::class, 'dashboard'])->middleware('auth');
// Route::get('/customer/dashboard', [OrderController::class, 'dashboard']);

Route::get('/customer/profile', function () {
    return view('customer.profile');
})->middleware('auth');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->middleware('auth');
Route::post('/profile/address', [AuthController::class, 'updateAddress'])->middleware('auth');
Route::post('/profile/password', [AuthController::class, 'changePassword'])->middleware('auth');

// Route::get('/customer/orders', function () {
//     return view('customer.orders');
// })->middleware('auth');
Route::get('/customer/orders', [OrderController::class, 'myOrder'])->middleware('auth');
Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth');
Route::post('/apply-coupon', [CartController::class, 'applyCoupon']);
Route::get('/cart/check/{id}', function ($id) {

    $exists = Cart::where('user_id', auth()->id())
        ->where('product_id', $id)
        ->exists();

    $hasCartItems = Cart::where('user_id', auth()->id())->exists();

    return response()->json([
        'exists' => $exists,
        'hasCartItems' => $hasCartItems
    ]);
});
Route::get('/customer/payments', function () {

    $payments = Payment::where('user_id', auth()->id())
        ->latest()
        ->paginate(10);
    $totalTransactions = $payments->total(); // pagination wala count
    return view('customer.payments', compact('payments', 'totalTransactions'));

})->middleware('auth');
Route::post('/add-payment', [OrderController::class, 'addPayment']);
Route::get('/order-remaining/{id}', function ($id) {

    $order = Order::find($id);

    if (!$order) {
        return response()->json([
            'total' => 0,
            'paid' => 0,
            'remaining' => 0
        ]);
    }

    $paid = Payment::where('order_id', $order->id)
        ->where('status', 'done')   // ✅ ONLY DONE
        ->sum('amount');

    return response()->json([
        'total' => (float) $order->total_price,
        'paid' => (float) $paid,
        'remaining' => max(0, $order->total_price - $paid)
    ]);
});

Route::get('/cart', function () {
    $cartItems = \App\Models\Cart::with('product')
        ->where('user_id', auth()->id())
        ->get();

    return view('Landing.cart', compact('cartItems'));
})->middleware('auth');

Route::get('/checkout-sales/{order_id}', function ($order_id) {


    $order = Order::with('items.product.locations')
        ->where('id', $order_id)
        ->firstOrFail();

    $orderData = $order->items->map(function ($item) {
        return [
            'id' => $item->id,
            'name' => $item->product->title,
            'sku' => $item->product->sku_code,
            'price' => $item->product->price,
            'totalQuantity' => $item->product->locations()->sum('quantity'),
            'moq' => 1,
            'qty' => $item->quantity,
            'lineTotal' => $item->product->price * $item->quantity
        ];
    });

    return view('SalesRep.checkout', compact('orderData', 'order'));
});

Route::get('/checkout-inventory/{order_id}', function ($order_id) {


    $order = Order::with('items.product.locations')
        ->where('id', $order_id)
        ->firstOrFail();

    $orderData = $order->items->map(function ($item) {
        return [
            'id' => $item->id,
            'name' => $item->product->title,
            'sku' => $item->product->sku_code,
            'price' => $item->product->price,
            'totalQuantity' => $item->product->locations()->sum('quantity'),
            'moq' => 1,
            'qty' => $item->quantity,
            'lineTotal' => $item->product->price * $item->quantity
        ];
    });

    $drivers = User::where('role', 'driver')->where('status', 'active')->get();

    return view('Inventory.checkout', compact('orderData', 'order', 'drivers'));
});


Route::post('/order/assign-driver', function (\Illuminate\Http\Request $req) {

    $order = Order::findOrFail($req->order_id);

    $order->assigned_driver = $req->driver_id;
    $order->delivery_date = $req->delivery_date;
    $order->save();

    return response()->json(['success' => true]);
});

Route::get('/checkout', function () {

    $cartItems = \App\Models\Cart::with('product')
        ->where('user_id', auth()->id())
        ->get();

    // ✅ JS friendly array banao
    $cartData = $cartItems->map(function ($item) {
        return [
            'id' => $item->id, // ✅ MUST
            'name' => $item->product->title,
            'sku' => $item->product->sku_code,
            'price' => $item->product->price,
            'moq' => 1,
            'qty' => max(5, $item->quantity),
            'lineTotal' => $item->product->price * max(5, $item->quantity)
        ];
    });

    return view('Landing.checkout', compact('cartItems', 'cartData'));
});

Route::post('/order-item/update', function (Request $req) {

    $item = OrderItem::findOrFail($req->order_item_id);

    $oldQty = $item->quantity; // 🔥 old value
    $item->quantity = $req->qty;
    $item->save();

    // ✅ LOG ENTRY
    OrderLog::create([
        'order_id' => $item->order_id,
        'order_item_id' => $item->id,
        'user_id' => auth()->id(),
        'action_type' => 'quantity_update',
        'old_value' => $oldQty,
        'new_value' => $req->qty
    ]);

    return response()->json(['success' => true]);
});

// Route::post('/order/update-status', function (Request $req) {

//     $order = Order::findOrFail($req->order_id);
//     $oldStatus = $order->status; // 🔥 old status
//     $order->status = $req->status;
//     $order->save();

//     // ✅ LOG ENTRY
//     OrderLog::create([
//         'order_id' => $order->id,
//         'user_id' => auth()->id(),
//         'action_type' => 'status_update',
//         'old_value' => $oldStatus,
//         'new_value' => $req->status
//     ]);

//     return response()->json(['success' => true]);
// });
Route::post('/order/update-status', function (Request $req) {

    $order = Order::with('items')->findOrFail($req->order_id);

    $oldStatus = $order->status;

    if(!in_array($req->status, ['accepted', 'created'])) {
        $order->status = $req->status;
    }
    
    $order->is_active = 0;
    $order->save();

    // ✅ FIXED CONDITION
    if (in_array($req->status, ['accepted', 'created'])) {

        $order2 = Order::create([
            'user_id' => $order->user_id,
            'total_price' => $order->total_price,
            'status' => $req->status,
            'discount' => $order->discount,
            'delivery_instructions' => $order->delivery_instructions,
            'internal_notes' => $order->internal_notes,
            'parent_order_id' => $order->id,
            'is_active' => 1
        ]);

        foreach ($order->items as $item) {
            OrderItem::create([
                'order_id' => $order2->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }
    }

    // ✅ LOG ENTRY
    OrderLog::create([
        'order_id' => $order->id,
        'user_id' => auth()->id(),
        'action_type' => 'status_update',
        'old_value' => $oldStatus,
        'new_value' => $req->status
    ]);

    return response()->json(['success' => true]);
});
Route::post('/order-item/add', [OrderController::class, 'addItem2']);


Route::post('/order-item/delete', function (Request $req) {

    OrderItem::where('id', $req->order_item_id)->delete();

    return response()->json(['success' => true]);
});
Route::get('/products/search', [ProductController::class, 'search']);

Route::get('/order/{id}', [OrderController::class, 'view'])->middleware('auth');

Route::post('/cart/update', function (Request $request) {

    \App\Models\Cart::where('id', $request->cart_id)
        ->update(['quantity' => $request->qty]);

    return response()->json(['success' => true]);
});
Route::post('/cart/delete', [CartController::class, 'delete'])->middleware('auth');
// Route::post('/place-order', [OrderController::class, 'placeOrder'])->middleware('auth');
Route::post('/place-order', [OrderController::class, 'placeOrder'])->middleware('auth');
Route::post('/save-draft', [OrderController::class, 'saveDraft'])->middleware('auth');
Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->middleware('auth');

Route::get('/orderstatus/{id}', [OrderController::class, 'viewDraft']);
Route::post('/draft/place/{id}', [OrderController::class, 'placeDraftOrder']);
Route::post('/order/add-item', [OrderController::class, 'addItem']);
Route::post('/order/update-item', [OrderController::class, 'updateItem']);
Route::post('/order/delete-item', [OrderController::class, 'deleteItem']);