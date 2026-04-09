<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;

class OrderController extends Controller
{
    
    // 📦 PLACE ORDER
    public function store()
    {
        $items = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($items->isEmpty()) {
            return redirect('/cart')->with('error', 'Cart is empty');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => 0
        ]);

        $total = 0;

        foreach ($items as $item) {

            $total += $item->product->price * $item->quantity;

            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        $order->update([
            'total_price' => $total
        ]);

        Cart::where('user_id', auth()->id())->delete();

        return redirect('/my-orders')->with('success', 'Order placed successfully');
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
}