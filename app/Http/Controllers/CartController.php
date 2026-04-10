<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

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

}
