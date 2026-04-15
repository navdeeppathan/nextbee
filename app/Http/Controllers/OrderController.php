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

        $orders = Order::with(['items.product', 'payment'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        $totalOrders = Order::where('user_id', auth()->id())->count();
        $totalSpent = Order::where('user_id', auth()->id())->sum('total_price');
        $cartCount = Cart::where('user_id', auth()->id())->count();

        $categories = Category::all();
        $products = Product::all();

        return view('customer.orders', compact(
            'orders',
            'categories',
            'products',
            'totalOrders',
            'totalSpent',
            'cartCount'
        ));
    }


    public function view($id)
    {
        $order = Order::with('items.product')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $orderData = $order->items->map(function ($item) {
            return [
                'name' => $item->product->title ?? 'Product',
                'sku' => $item->product->sku_code ?? '-',
                'moq' => $item->product->moq ?? 1, // ✅ ADD THIS
                'price' => (float) ($item->price ?? 0),
                'qty' => (int) $item->quantity,
                'lineTotal' => (float) ($item->price ?? 0) * $item->quantity
            ];
        });

        return view('customer.view-order', compact('order', 'orderData'));
    }
    public function invoice($id)
    {
        $payment = Payment::with('order.items.product')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $order = $payment->order;

        return view('customer.invoice', compact('payment', 'order'));
    }
    public function dashboard()
    {
        $userId = auth()->id();



        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->where('status', '!=', 'draft')
            ->latest()
            ->get();

        $draftOrders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->where('status', 'draft')
            ->latest()
            ->get();

        $totalOrders = Order::where('user_id', auth()->id())->count();
        $totalSpent = Order::where('user_id', auth()->id())->sum('total_price');
        $cartCount = Cart::where('user_id', auth()->id())->count();

        $categories = Category::all();
        $products = Product::all();

        return view('customer.dashboard-home', compact(
            'orders',
            'draftOrders',
            'categories',
            'products',
            'totalOrders',
            'totalSpent',
            'cartCount'
        ));


    }


    public function updateNotes(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'delivery_instruction' => 'nullable|string|max:500',
            'order_note' => 'nullable|string|max:500',
        ]);

        $order = Order::where('id', $id)->firstOrFail();

        $order->update($request->only([
            'delivery_instruction',
            'order_note'
        ]));

        return redirect()->back()->with('success', 'Order updated successfully ✅');
    }

    public function placeOrder(Request $request)
    {
        \Log::info($request->all());
        $data = $request->all();

        $delivery = $data['delivery_instructions'] ?? null;
        $notes = $data['internal_notes'] ?? null;
        $discount = $data['discount'] ?? 0;

        $items = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($items->isEmpty()) {
            return response()->json(['error' => 'Cart empty']);
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => 0,
            'status' => 'created',
            'delivery_instructions' => $delivery,
            'internal_notes' => $notes
        ]);

        $total = 0;

        foreach ($items as $item) {

            $price = $item->product->price;
            $qty = max(5, $item->quantity);

            $total += $price * $qty;

            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $qty,
                'price' => $price
            ]);
        }

        $finalTotal = $total - $discount;

        if ($finalTotal < 0) {
            $finalTotal = 0;
        }

        $order->update([
            'total_price' => $finalTotal,
            'discount' => $discount
        ]);

        Payment::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            // 'amount' => $finalTotal,
            'amount' => 0,

            'method' => 'UPI',
            'status' => 'pending'
        ]);

        Cart::where('user_id', auth()->id())->delete();

        return response()->json(['success' => true]);
    }
    public function saveDraft(Request $request)
    {
        $data = $request->all();

        $delivery = $data['delivery_instructions'] ?? null;
        $notes = $data['internal_notes'] ?? null;
        $discount = $data['discount'] ?? 0;

        $items = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($items->isEmpty()) {
            return response()->json(['success' => false]);
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => 0,
            'status' => 'draft',
            'delivery_instructions' => $delivery,
            'internal_notes' => $notes,
            'discount' => $discount // ✅ ADD THIS
        ]);

        $total = 0;

        foreach ($items as $item) {

            $price = $item->product->price;
            $qty = max(5, $item->quantity);

            $total += $price * $qty;

            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $qty,
                'price' => $price
            ]);
        }

        // ✅ FINAL TOTAL AFTER DISCOUNT
        $finalTotal = $total - $discount;

        if ($finalTotal < 0) {
            $finalTotal = 0;
        }

        $order->update([
            'total_price' => $finalTotal
        ]);
        Cart::where('user_id', auth()->id())->delete();


        return response()->json(['success' => true]);
    }

    public function viewDraft($id)
    {
        $order = Order::with('items.product')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'draft')
            ->firstOrFail();

        $cartData = $order->items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->product->title,
                'sku' => $item->product->sku_code,
                'moq' => $item->product->moq,
                'price' => $item->price,
                'qty' => $item->quantity,
                'lineTotal' => $item->price * $item->quantity
            ];
        });

        return view('Landing.draftcheckout', compact('order', 'cartData'));
    }

    public function placeDraftOrder(Request $request, $id)
    {
        $order = Order::with('items.product')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'draft')
            ->firstOrFail();

        $data = $request->all();

        $delivery = $data['delivery_instructions'] ?? null;
        $notes = $data['internal_notes'] ?? null;
        $discount = $data['discount'] ?? 0;

        $total = 0;

        foreach ($order->items as $item) {

            $price = $item->price;
            $qty = $item->quantity;

            $total += $price * $qty;
        }

        $finalTotal = $total - $discount;
        if ($finalTotal < 0)
            $finalTotal = 0;

        // ✅ UPDATE SAME ORDER
        $order->update([
            'status' => 'created',
            'delivery_instructions' => $delivery,
            'internal_notes' => $notes,
            'discount' => $discount,
            'total_price' => $finalTotal
        ]);

        // ✅ CREATE PAYMENT
        Payment::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'amount' => 0,
            // 'amount' => $finalTotal,
            'method' => 'UPI',
            'status' => 'pending'
        ]);

        return response()->json(['success' => true]);
    }
    public function addPayment(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $amount = (float) $request->amount;

        // ✅ total paid (ONLY DONE)
        $totalPaid = Payment::where('order_id', $order->id)
            ->where('status', 'done')
            ->sum('amount');

        $remaining = $order->total_price - $totalPaid;

        if ($amount <= 0) {
            return response()->json(['error' => 'Invalid amount']);
        }

        if ($amount > $remaining) {
            return response()->json(['error' => 'Exceeds remaining']);
        }

        // ✅ NEW ENTRY (history)
        Payment::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'amount' => $amount,
            'method' => 'UPI',
            'status' => 'done'
        ]);

        $finalPaid = $totalPaid + $amount;

        // ✅ STATUS LOGIC
        if ($finalPaid == 0) {
            $status = 'pending';
        } elseif ($finalPaid < $order->total_price) {
            $status = 'partial';
        } else {
            $status = 'full';
        }

        $order->update([
            'payment_status' => $status
        ]);

        return response()->json([
            'success' => true,
            'paid' => $finalPaid,
            'remaining' => $order->total_price - $finalPaid,
            'status' => $status
        ]);

    }
}