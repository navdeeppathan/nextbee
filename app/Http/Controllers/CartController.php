<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;

class CartController extends Controller
{


    public function add(Request $request)
    {
        $qty = $request->quantity ?? 1; // 👈 modal se qty aayegi

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->increment('quantity', $qty); // ✅ proper increment
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $qty // ✅ correct qty save
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        Cart::where('id', $request->cart_id)
            ->where('user_id', auth()->id())
            ->delete();

        return response()->json(['success' => true]);
    }
//     public function applyCoupon(Request $request)
// {
//     $request->validate([
//         'code' => 'required'
//     ]);

//     $coupon = Coupon::where('code', $request->code)
//         ->where('status', 1)
//         ->first();

//     if (!$coupon) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Invalid Coupon ❌'
//         ]);
//     }

//     // Expiry check
//     if ($coupon->expires_at && now()->gt($coupon->expires_at)) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Coupon expired ❌'
//         ]);
//     }

//     // Cart total calculate
//     $cart = Cart::where('user_id', auth()->id())
//         ->with('product')
//         ->get();

//     $total = 0;

//     foreach ($cart as $item) {
//         $total += $item->product->price * $item->quantity;
//     }

//     // Minimum amount check
//     if ($coupon->min_amount && $total < $coupon->min_amount) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Minimum order £' . $coupon->min_amount
//         ]);
//     }

//     return response()->json([
//         'success' => true,
//         'coupon' => $coupon
//     ]);
// }


public function applyCoupon(Request $request)
{
    $request->validate([
        'code' => 'required'
    ]);

    // ✅ FIX 1: case-insensitive
    $coupon = Coupon::where('code', strtoupper(trim($request->code)))
        ->where('status', 1)
        ->first();

    if (!$coupon) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid Coupon ❌'
        ]);
    }

    // ✅ Expiry check
    if ($coupon->expires_at && now()->gt($coupon->expires_at)) {
        return response()->json([
            'success' => false,
            'message' => 'Coupon expired ❌'
        ]);
    }

    // 🔥 IMPORTANT LOGIC (CART + ORDER BOTH)

    $total = 0;

    // ✅ 1. CHECK ACTIVE ORDER FIRST
    $order = Order::where('user_id', auth()->id())
        ->where('is_active', 1)
        ->latest()
        ->first();

    if ($order && $order->items->count() > 0) {

        // 👉 ORDER TOTAL
        $total = $order->items->sum(fn($i) => $i->price * $i->quantity);

    } else {

        // 👉 CART TOTAL
        $cart = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        foreach ($cart as $item) {
            $total += $item->product->price * $item->quantity;
        }
    }

    // ✅ Minimum check
    if ($coupon->min_amount && $total < $coupon->min_amount) {
        return response()->json([
            'success' => false,
            'message' => 'Minimum order £' . $coupon->min_amount
        ]);
    }

    return response()->json([
        'success' => true,
        'coupon' => [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value
        ]
    ]);
}
}
