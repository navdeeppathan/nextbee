<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Payment;

class OrderController extends Controller
{
    
    // 📦 PLACE ORDER
   public function store(Request $request)
{
    $items = $request->items;

    if (!$items || count($items) === 0) {
        return response()->json([
            'success' => false,
            'message' => 'No items'
        ]);
    }

    $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => 0
    ]);

    $total = 0;

    foreach ($items as $item) {

        $price = $item['price'] ?? 0;
        $qty = $item['qty'] ?? 1;

        $total += $price * $qty;

        $order->items()->create([
            'product_id' => null, // agar product_id bhejna hai to add karo
            'quantity' => $qty,
            'price' => $price
        ]);
    }

    $order->update([
        'total_price' => $total
    ]);

    return response()->json([
        'success' => true
    ]);
}

    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('order-details', compact('order'));
    }
    public function reorder($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        foreach ($order->items as $item) {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        return redirect('/cart')->with('success', 'Items added to cart again!');
    }
    // 📋 MY ORDERS
   public function index()
{
    $orders = Order::where('user_id', auth()->id())->latest()->get();
    $categories = Category::all();
    $products = Product::all(); // 👈 ADD THIS

    return view('orders', compact('orders', 'categories', 'products'));
}

   public function myOrder()
{
    $orders = Order::where('user_id', auth()->id())->latest()->get();
    $categories = Category::all();
    $products = Product::all(); // 👈 ADD THIS

    return view('customer.orders', compact('orders', 'categories', 'products'));
}

public function placeOrder()
{
    $items = Cart::where('user_id', auth()->id())
        ->with('product')
        ->get();

    if ($items->isEmpty()) {
        return redirect('/cart')->with('error', 'Cart empty');
    }

    $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => 0
    ]);

    $total = 0;

   foreach ($items as $item) {

    $price = $item->product->price;

    $qty = max(5, $item->quantity);

    $total += $price * $qty;

    $order->items()->create([
        'product_id' => $item->product_id,
        'quantity' => $qty,
    ]);
}

    $order->update([
        'total_price' => $total
    ]);
     // ✅ PAYMENT SAVE
    Payment::create([
        'order_id' => $order->id,
        'user_id' => auth()->id(),
        'amount' => $total,
        'method' => 'UPI', // ya dynamic bana sakte ho
        'status' => 'Paid'
    ]);

    Cart::where('user_id', auth()->id())->delete();

    return redirect('/customer/orders')->with('success', 'Order placed ✅');
}
}