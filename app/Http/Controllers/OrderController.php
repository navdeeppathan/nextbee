<?php

namespace App\Http\Controllers;

use App\Mail\ReturnStatusMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Location;
use App\Models\OrderReturn;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
            ->where('is_active', 1) // ✅ IMPORTANT
            ->latest()
            ->paginate(10);

        $totalOrders = Order::where('user_id', auth()->id())
            ->where('is_active', 1)
            ->count();
        $totalSpent = Order::where('user_id', auth()->id())
            ->where('is_active', 1)
            ->sum('total_price');
        $cartCount = Cart::where('user_id', auth()->id())->count();
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        // ✅ TOTAL PRICE CALCULATION
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $categories = Category::all();
        $products = Product::all();

        return view('customer.orders', compact(
            'orders',
            'categories',
            'products',
            'totalOrders',
            'totalSpent',
            'cartCount',
            'cartTotal'
        ));
    }


    public function view($id)
    {
        $order = Order::with('items.product')
            ->where('is_active', 1) // ✅ IMPORTANT
            ->where('parent_order_id', $id)
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

        // ✅ ACTIVE ORDERS
        $orders = Order::with('items.product')
            ->where('user_id', $userId)
            ->where('is_active', 1) // ✅ IMPORTANT
            ->whereIn('status', [
                'draft',
                'created',
                'accepted',
                'ready for delivery',
                'out for delivery'
            ])
            ->latest()
            ->get();

        // ✅ DELIVERED ORDERS
        $draftOrders = Order::with('items.product')
            ->where('user_id', $userId)
            ->where('status', 'delivered')
            ->latest()
            ->get();

        $totalOrders = Order::where('user_id', $userId)
            ->where('is_active', 1)
            ->count();
        $totalSpent = Order::where('user_id', $userId)
            ->where('is_active', 1)
            ->sum('total_price');
        $cartCount = Cart::where('user_id', $userId)->count();
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        // ✅ TOTAL PRICE CALCULATION
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $categories = Category::all();
        $products = Product::all();

        return view('customer.dashboard-home', compact(
            'orders',
            'draftOrders',
            'categories',
            'products',
            'totalOrders',
            'totalSpent',
            'cartCount',
            'cartTotal' // 🔥 ADD THIS
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
        // \Log::info($request->all());
        $data = $request->all();

        $delivery = $data['delivery_instructions'] ?? null;
        $notes = $data['internal_notes'] ?? null;
        $discount = $data['discount'] ?? 0;



        if ($request->user_id) {
            $items = Cart::where('user_id', $request->user_id)
                ->with('product')
                ->get();
        } else {
            $items = Cart::where('user_id', auth()->id())
                ->with('product')
                ->get();
        }


        if ($items->isEmpty()) {
            return response()->json(['error' => 'Cart empty']);
        }

        if ($request->user_id) {
            $order = Order::create([
                'user_id' => $request->user_id,
                'total_price' => 0,
                'status' => 'created',
                'delivery_instructions' => $delivery,
                'internal_notes' => $notes,
                'parent_order_id' => 0, // temp
                'is_active' => 1
            ]);
        } else {

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => 0,
                'status' => 'created',
                'delivery_instructions' => $delivery,
                'internal_notes' => $notes,
                'parent_order_id' => 0, // temp
                'is_active' => 1
            ]);

        }
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
            'discount' => $discount,
            'parent_order_id' => $order->id // 🔥 MAIN FIX
        ]);

        if ($request->user_id) {
            Cart::where('user_id', $request->user_id)->delete();
        } else {
            Cart::where('user_id', auth()->id())->delete();
        }

        try {
            $customer = User::find($order->user_id);

            // ✅ Only if customer has Xero contact
            if ($customer && $customer->xero_contact_id) {

                $xero = new XeroController();

                $response = $xero->createInvoice($customer, $order);

                // ✅ OPTIONAL: store invoice ID
                if (isset($response['Invoices'][0]['InvoiceID'])) {
                    $order->update([
                        'xero_invoice_id' => $response['Invoices'][0]['InvoiceID']
                    ]);
                }
            }

        } catch (\Exception $e) {
            \Log::error('Xero Invoice Error: ' . $e->getMessage());
        }

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
            'discount' => $discount, // ✅ ADD THIS
            'parent_order_id' => 0,
            'is_active' => 1
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
            'total_price' => $finalTotal,
            'parent_order_id' => $order->id
        ]);
        Cart::where('user_id', auth()->id())->delete();


        return response()->json(['success' => true]);
    }

    public function viewDraft($id)
    {
        $order = Order::with('items.product')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->whereIn('status', ['draft', 'created', 'accepted'])
            ->where('is_active', 1)
            ->firstOrFail();

        $cartData = $order->items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->product->title,
                'sku' => $item->product->sku_code,
                'moq' => $item->product->moq,
                'price' => $item->price,
                'qty' => $item->quantity,
                'lineTotal' => $item->price * $item->quantity,
                'product_id' => $item->product->id, // 🔥 ADD
                'category_id' => $item->product->category_id, // 🔥 ADD

            ];
        });

        return view('Landing.draftcheckout', compact('order', 'cartData'));
    }

    public function placeDraftOrder(Request $request, $id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->whereIn('status', ['draft', 'created', 'accepted'])
            ->where('is_active', 1)
            ->firstOrFail();

        $delivery = $request->delivery_instructions;
        $notes = $request->internal_notes;
        $discount = $request->discount ?? 0;

        $total = $order->items->sum(fn($i) => $i->price * $i->quantity);
        $finalTotal = max(0, $total - $discount);

        // ✅ DRAFT → SAME UPDATE
        if ($order->status == 'draft') {

            $order->update([
                'status' => 'created',
                'delivery_instructions' => $delivery,
                'internal_notes' => $notes,
                'discount' => $discount,
                'total_price' => $finalTotal
            ]);

            return response()->json(['success' => true]);
        }

        // ✅ OLD INACTIVE
        $order->update(['is_active' => 0]);

        // ✅ NEW ORDER
        $newOrder = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $finalTotal,
            'status' => 'created',
            'delivery_instructions' => $delivery,
            'internal_notes' => $notes,
            'discount' => $discount,
            'parent_order_id' => $order->parent_order_id ?? $order->id,
            'is_active' => 1
        ]);

        // ✅ COPY ITEMS
        foreach ($order->items as $item) {
            $newOrder->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        return response()->json(['success' => true]);
    }
    public function addPayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'method' => 'required|in:bank,cheque,cash',
        ]);



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

        // ✅ PREPARE PAYMENT DATA
        $paymentData = [
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'amount' => $amount,
            'method' => $request->method,
            'status' => 'done'
        ];

        // ✅ EXTRA FIELDS BASED ON MODE
        if ($request->method === 'bank') {

            if (!$request->account_name) {
                return response()->json(['error' => 'Account name required']);
            }

            $paymentData['account_name'] = $request->account_name;
        }

        if ($request->method === 'cheque') {

            if (!$request->cheque_number) {
                return response()->json(['error' => 'Cheque number required']);
            }

            $paymentData['cheque_number'] = $request->cheque_number;
        }

        // ✅ NEW ENTRY (history)
        // Payment::create([
        //     'order_id' => $order->id,
        //     'user_id' => auth()->id(),
        //     'amount' => $amount,
        //     // 'method' => 'UPI',
        //     'method' => $request->method,
        //     'status' => 'done'
        // ]);

        // cash → no extra fields

        // ✅ SAVE PAYMENT
        Payment::create($paymentData);

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



    public function addItem2(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $product = Product::findOrFail($request->product_id);

        // ✅ check if already exists
        $existing = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->quantity += $request->quantity;
            $existing->price = $product->price;
            $existing->save();
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
        }

        // 🔥 update order total
        $this->updateOrderTotal($order->id);

        return response()->json(['success' => true]);
    }
    private function updateOrderTotal($orderId)
    {
        $order = Order::with('items')->find($orderId);

        $total = $order->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $order->update([
            'total_price' => $total
        ]);

        return $total;
    }
    public function addItem(Request $request)
    {
        $order = Order::where('id', $request->order_id)
            ->where('user_id', auth()->id())
            ->whereIn('status', ['draft', 'created', 'accepted'])
            ->where('is_active', 1)
            ->firstOrFail();

        $product = Product::findOrFail($request->product_id);

        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => 5,
            'price' => $product->price
        ]);

        return response()->json(['success' => true]);
    }
    public function updateItem(Request $request)
    {
        $item = OrderItem::findOrFail($request->item_id);

        $order = $item->order;

        if (!in_array($order->status, ['draft', 'created', 'accepted']) || !$order->is_active) {
            return response()->json(['error' => 'Not allowed']);
        }

        $item->update([
            'quantity' => max(5, $request->qty)
        ]);

        return response()->json(['success' => true]);
    }
    public function deleteItem(Request $request)
    {
        $item = OrderItem::findOrFail($request->item_id);

        $order = $item->order;

        if (!in_array($order->status, ['draft', 'created', 'accepted']) || !$order->is_active) {
            return response()->json(['error' => 'Not allowed']);
        }

        $item->delete();

        return response()->json(['success' => true]);

    }

    public function updateAllocation(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required',
            'is_allocated' => 'required|boolean'
        ]);

        $item = OrderItem::find($request->order_item_id);

        $item->is_allocated = $request->is_allocated;
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Allocation updated successfully'
        ]);
    }


    public function storeOrderReturn(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required'
        ]);

        OrderReturn::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
            'reason' => $request->reason,
            'status' => 'pending',
            'refund_status' => 'pending',
            'return_number' => 'RET-' . strtoupper(uniqid())
        ]);

        return response()->json([
            'success' => true
        ]);
    }



    public function getReturnsGrouped()
    {
        $returns = OrderReturn::with(['product', 'order.user'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('order_id'); // 🔥 MAIN MAGIC

        $finalData = [];

        foreach ($returns as $orderId => $items) {

            $order = $items->first()->order;

            $totalRefund = $items->sum(function ($item) {
                return $item->quantity * ($item->product->price ?? 0);
            });

            $finalData[] = [
                'return_number' => $items->first()->return_number,
                'status' => $items->first()->status,
                'submitted_at' => $items->first()->created_at,

                'customer' => [
                    'name' => $order->user->name ?? '',
                    'email' => $order->user->email ?? ''
                ],

                'items' => $items->map(function ($item) {
                    return [
                        'product_name' => $item->product->title ?? '',
                        'sku' => $item->product->sku_code ?? '',
                        'quantity' => $item->quantity,
                        'reason' => $item->reason,
                        'price' => $item->product->price ?? 0,
                        'total' => $item->quantity * ($item->product->price ?? 0),
                        'product_id' => $item->product_id,
                        'id' => $item->id
                    ];
                }),

                'summary' => [
                    'total_items_value' => $totalRefund,
                    'refund_amount' => $totalRefund,
                ]
            ];
        }

        return view('Inventory.returns', [
            'returns' => $finalData
        ]);
    }



    public function updateStatus(Request $request)
    {
        $request->validate([
            'return_number' => 'required',
            'status' => 'required|in:approved,rejected'
        ]);

        // 🔥 Get all items of this return_number
        $returns = OrderReturn::where('return_number', $request->return_number)->get();

        if ($returns->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Return not found'
            ]);
        }

        $totalRefund = 0;

        foreach ($returns as $return) {

            $return->status = $request->status;

            // ✅ If approved → process refund
            if ($request->status === 'approved') {

                $price = $return->product->price ?? 0;
                $refund = $return->quantity * $price;

                $return->refund_amount = $refund;
                $return->refund_status = 'processed';

                $totalRefund += $refund;

            }

            // ❌ If rejected
            if ($request->status === 'rejected') {
                $return->refund_status = 'failed';
                $return->refund_amount = 0;
            }

            $return->save();
        }

        $user = $returns->first()->order->user;

        if ($user && $user->email) {
            Mail::to($user->email)->send(
                new ReturnStatusMail(
                    $request->return_number,
                    $request->status,
                    $returns,
                    $totalRefund
                )
            );
        }


        return response()->json([
            'success' => true,
            'message' => 'Return ' . $request->status . ' successfully'
        ]);
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'return_id' => 'required',
            'location_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $return = OrderReturn::find($request->return_id);

        if (!$return || $return->status !== 'approved') {
            return response()->json([
                'success' => false,
                'message' => 'Invalid return'
            ]);
        }

        $location = Location::find($request->location_id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found'
            ]);
        }

        // ✅ Update stock
        $location->quantity += $request->quantity;
        $location->save();

        return response()->json([
            'success' => true,
            'message' => 'Stock updated successfully'
        ]);
    }

    public function againOrder($id)
    {
        $userId = auth()->id();

        // ✅ order fetch
        $order = Order::with('items.product')
            ->where('user_id', $userId)
            ->where('parent_order_id', $id)
            ->firstOrFail();

        // ✅ OPTIONAL: pehle cart empty karo
        Cart::where('user_id', $userId)->delete();

        foreach ($order->items as $item) {

            // ✅ check if already exists
            $existing = Cart::where('user_id', $userId)
                ->where('product_id', $item->product_id)
                ->first();

            if ($existing) {
                $existing->quantity += $item->quantity;
                $existing->save();
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                ]);
            }
        }

        // ✅ DIRECT CHECKOUT PAGE
        return redirect('/checkout')->with('success', 'Order copied to cart!');
    }

}