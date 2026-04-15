<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Sales Order | Metro Wholesale B2B Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --navy: #0f172a;
            --royal: #1e40af;
            --gold: #d4af37;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }

        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Order Line Styles */
        .order-line {
            transition: all 0.2s ease;
        }

        .order-line:hover {
            background: #f8fafc;
        }

        /* Quantity Stepper */
        .qty-stepper {
            display: flex;
            align-items: center;
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .qty-stepper button {
            width: 32px;
            height: 32px;
            background: #f1f5f9;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .qty-stepper button:hover {
            background: #e2e8f0;
        }

        .qty-stepper input {
            width: 60px;
            height: 32px;
            border: none;
            text-align: center;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* Product Search Dropdown */
        .product-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-height: 300px;
            overflow-y: auto;
            z-index: 50;
            display: none;
        }

        .product-dropdown.active {
            display: block;
        }

        .product-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s;
        }

        .product-item:hover {
            background: #f8fafc;
        }

        /* Sticky Summary */
        .sticky-summary {
            position: sticky;
            top: 20px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e40af;
            border-radius: 4px;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.3s ease;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #0f172a;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            z-index: 100;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }
    </style>

</head>
<script>
    let orderLines = @json($orderData); // ✅ DB data
    let orderId = {{ $order->id }};
    let order = @json($order);
    console.log(orderLines);
</script>

<body class="bg-slate-50">

    <!-- Navigation -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-4">
                    <a href="/main" class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-900 to-blue-700 rounded-xl flex items-center justify-center">
                            <i class="fas fa-building text-white"></i>
                        </div>
                        <div>
                            <h1 class="font-display text-xl font-bold text-slate-900">METRO</h1>
                            <p class="text-xs text-slate-500">B2B WHOLESALE</p>
                        </div>
                    </a>
                    <span class="text-slate-300">|</span>
                    <span class="text-lg font-semibold text-slate-800">Update Sales Order</span>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden md:block">
                        <p class="text-xs text-slate-500">{{ Auth::user()->role }}</p>
                        <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-900 font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="font-display text-3xl font-bold text-slate-900">Sales Order</h1>
                    {{-- <p class="text-slate-500 mt-1">Create a new sales order for your business</p> --}}
                </div>
                <div class="flex items-center gap-3">
                    <!-- <span class="text-sm text-slate-500">Order #:</span> -->
                    <a href="{{redirect()->back()->getTargetUrl()}}">

                        <!-- <span class="font-mono font-semibold text-blue-900 bg-blue-50 px-3 py-1 rounded-lg"> Back</span> -->
                        <button
                            class="px-4 py-2 bg-slate-800 text-white text-sm font-medium rounded-lg hover:bg-slate-700 transition">
                            Back
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Left Column: Order Form -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Customer Information -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h2 class="font-display text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-building text-blue-900"></i>
                        Customer Information
                    </h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Customer Name</label>
                            <input type="text" value="{{ $order->user->name }}"
                                class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none bg-slate-50"
                                readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Customer ID</label>
                            <input type="text" value="MET-78432"
                                class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none bg-slate-50"
                                readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Delivery Email</label>
                            <input type="text" value="{{ $order->user->email }}"
                                class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none bg-slate-50"
                                readonly>
                        </div>
                        
                    </div>
                </div>

                <!-- Order Lines Section -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-display text-lg font-semibold text-slate-900 flex items-center gap-2">
                            <i class="fas fa-list-ul text-blue-900"></i>
                            Order Lines
                        </h2>
                        <span class="text-sm text-slate-500" id="line-count">0 items</span>
                        <span class="px-3 py-1 text-xs rounded-full font-semibold 
                            {{ $order->status == 'created' ? 'bg-red-100 text-yellow-300' : 'bg-green-100 text-green-800' }}">
                            {{ $order->status }}
                        </span>
                        <select onchange="updateStatus(this.value)" class="border px-3 py-2 rounded-lg text-sm">
                            <option value="created" {{ $order->status == 'created' ? 'selected' : '' }}>Created</option>
                            <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="ready for delivery" {{ $order->status == 'ready for delivery' ? 'selected' : '' }}>Ready For Delivery</option>
                            <option value="out for delivery" {{ $order->status == 'out for delivery' ? 'selected' : '' }}>Out For Delivery</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                        
                    </div>

                    <!-- Add Product Search -->
                    
                    <div class="relative mb-6">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Add Product</label>
                        <div class="relative">
                            <input type="text" id="product-search" placeholder="Search by SKU, name, or category..."
                                class="w-full px-4 py-3 pl-11 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none"
                                oninput="searchProducts(this.value)">
                            <i
                                class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>

                        </div>

                        <!-- Product Dropdown -->
                        <div id="product-dropdown" class="product-dropdown">
                            <!-- Products will be populated here -->
                        </div>
                    </div>

                    <!-- Order Lines Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-slate-100">
                                    <th class="text-left py-3 px-2 text-xs font-semibold text-slate-500 uppercase">
                                        Product</th>
                                    <th
                                        class="text-center py-3 px-2 text-xs font-semibold text-slate-500 uppercase w-32">
                                        Qty (Cases)</th>

                                    <th
                                        class="text-right py-3 px-2 text-xs font-semibold text-slate-500 uppercase w-28">
                                        Inventory</th>
                                    <th
                                        class="text-right py-3 px-2 text-xs font-semibold text-slate-500 uppercase w-28">
                                        Unit Price</th>
                                    <th
                                        class="text-right py-3 px-2 text-xs font-semibold text-slate-500 uppercase w-28">
                                        Line Total</th>
                                    {{-- <th
                                        class="text-right py-3 px-2 text-xs font-semibold text-slate-500 uppercase w-28">
                                        Status</th> --}}
                                    <th
                                        class="text-center py-3 px-2 text-xs font-semibold text-slate-500 uppercase w-16">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody id="order-lines-body">
                                <!-- Empty State -->
                                <tr id="empty-state">
                                    <td colspan="5" class="py-12 text-center">
                                        <div
                                            class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-shopping-cart text-slate-400 text-2xl"></i>
                                        </div>
                                        <p class="text-slate-500 mb-2">No items added yet</p>
                                        <p class="text-sm text-slate-400">Search for products above to add to your order
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
                <!-- Notes & Instructions -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h2 class="font-display text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-sticky-note text-blue-900"></i>
                        Order Notes
                    </h2>
                    
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">
                                    Delivery Instructions
                                </label>
                                <textarea name="delivery_instruction" disabled rows="2"
                                    placeholder="e.g., Deliver to rear entrance..."
                                    class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none resize-none">{{ $order->delivery_instruction}}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">
                                    Internal Notes
                                </label>
                                <textarea name="order_note" disabled rows="2"
                                    placeholder="Notes for your team..."
                                    class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none resize-none">{{$order->order_note}}</textarea>
                            </div>
                        </div>
                
                </div>

            </div>

            <!-- Right Column: Order Summary -->
            <div class="lg:col-span-1">
                <div class="sticky-summary space-y-6">

                    <!-- Order Summary Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                        <h2 class="font-display text-lg font-semibold text-slate-900 mb-4">Order Summary</h2>

                        <!-- Coupon Code -->
                        {{-- <div class="mb-6 p-4 bg-slate-50 rounded-xl">
                            <label
                                class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wider">Coupon
                                Code</label>
                            <div class="flex gap-2">
                                <input type="text" id="coupon-input" placeholder="e.g., BULK10"
                                    class="flex-1 px-3 py-2 text-sm border-2 border-slate-200 rounded-lg focus:border-blue-900 focus:outline-none uppercase">
                                <button onclick="applyCoupon()"
                                    class="px-4 py-2 bg-slate-800 text-white text-sm font-medium rounded-lg hover:bg-slate-700 transition">
                                    Apply
                                </button>
                            </div>
                            <div id="coupon-message" class="text-xs mt-2"></div>
                            <div id="active-coupon"
                                class="hidden mt-2 flex items-center justify-between bg-green-50 px-3 py-2 rounded-lg">
                                <span class="text-xs text-green-700 font-medium" id="active-coupon-name"></span>
                                <button onclick="removeCoupon()"
                                    class="text-xs text-red-600 hover:underline">Remove</button>
                            </div>
                        </div> --}}

                        <!-- Totals -->
                        <div class="space-y-3 border-t border-slate-100 pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600">Total Items</span>
                                <span class="font-semibold text-slate-900" id="total-items">0 cases</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600">Subtotal</span>
                                <span class="font-semibold text-slate-900" id="subtotal">£0.00</span>
                            </div>

                            <!-- Discount Row -->
                            <div id="discount-row" class="flex justify-between text-sm hidden">
                                <span class="text-green-600 font-medium">Discount</span>
                                <span class="font-semibold text-green-600" id="discount-amount">-£0.00</span>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600">VAT (20%)</span>
                                <span class="font-semibold text-slate-900" id="vat-amount">£0.00</span>
                            </div>

                            <div class="flex justify-between text-lg font-bold pt-3 border-t-2 border-slate-200">
                                <span class="text-slate-900">Total</span>
                                <span class="text-blue-900" id="grand-total">£0.00</span>
                            </div>
                        </div>

                        <!-- Payment Terms -->
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                            <p class="text-xs text-blue-800">
                                <i class="fas fa-info-circle mr-1"></i>
                                Payment Terms: Net 30 days from invoice date
                            </p>
                        </div>

                        @php
                            $creditLimit = $order->user->credit_limit ?? 0;
                            $totalUsed = $order->total_price ?? 0;

                            $available = max($creditLimit - $totalUsed, 0);

                            $percentage = $creditLimit > 0 
                                ? min(($totalUsed / $creditLimit) * 100, 100) 
                                : 0;
                        @endphp
                        <!-- Credit Limit Info -->
                        {{-- <div class="mt-4 p-3 bg-slate-50 rounded-lg">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-slate-600">Credit Limit</span>
                                <span class="font-medium text-slate-900">£{{ $order->user->credit_limit ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-slate-600">Available</span>
                                <span class="font-medium text-green-600" id="credit-available">£{{ $order->user->credit_limit ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2 mt-2">
                                <div id="credit-bar" class="bg-green-500 h-2 rounded-full transition-all"
                                    style="width: 0%"></div>
                            </div>
                        </div> --}}
                        <div class="mt-4 p-3 bg-slate-50 rounded-lg">

                            <!-- Credit Limit -->
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-slate-600">Credit Limit</span>
                                <span class="font-medium text-slate-900">
                                    £{{ number_format($creditLimit, 2) }}
                                </span>
                            </div>

                            <!-- Available -->
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-slate-600">Available</span>
                                <span class="font-medium text-green-600">
                                    £{{ number_format($available, 2) }}
                                </span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="w-full bg-slate-200 rounded-full h-2 mt-2">
                                <div 
                                    class="h-2 rounded-full transition-all
                                    {{ $percentage > 80 ? 'bg-red-500' : ($percentage > 50 ? 'bg-yellow-500' : 'bg-green-500') }}"
                                    style="width: {{ $percentage }}%">
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <!-- Help Card -->
                    <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-2xl p-6 text-white">
                        <h3 class="font-semibold mb-2 flex items-center gap-2">
                            <i class="fas fa-headset"></i>
                            Need Help?
                        </h3>
                        <p class="text-sm text-blue-100 mb-4">Contact your account manager for assistance with large
                            orders or special pricing.</p>
                        <a href="tel:02079460958"
                            class="inline-flex items-center gap-2 text-sm font-medium hover:underline">
                            <i class="fas fa-phone"></i>
                            020 7946 0958 ext. 204
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="flex items-center gap-3">
            <i class="fas fa-check-circle text-green-400"></i>
            <span id="toast-message">Operation successful</span>
        </div>
    </div>

    
    <script>

        

        // ✅ render items
        function renderOrderLines() {

            const tbody = document.getElementById('order-lines-body');

            if (orderLines.length === 0) {
                tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center py-10">
                    No items in cart
                </td>
            </tr>
        `;
                return;
            }

            tbody.innerHTML = orderLines.map((line, index) => `
       


         <tr class="order-line border-b border-slate-100 animate-slide-in">
                    <td class="py-4 px-2">
                        <div>
                            <p class="font-medium text-slate-900">${line.name}</p>
                            <p class="text-xs text-slate-500">${line.sku} • MOQ: ${line.moq}</p>
                        </div>
                    </td>
                    <td class="py-4 px-2">
                        <div class="qty-stepper mx-auto">
                            <button onclick="updateQty(${index}, -1)">
                                <i class="fas fa-minus text-xs text-slate-600"></i>
                            </button>
                            <input type="number" value="${line.qty}" min="${line.moq}" 
                                onchange="setQty(${index}, this.value)"
                                class="focus:outline-none">
                            <button onclick="updateQty(${index}, 1)">
                                <i class="fas fa-plus text-xs text-slate-600"></i>
                            </button>
                        </div>
                    </td>
                    <td class="py-4 px-2 text-right">
                        <span class="text-sm font-medium text-slate-900">${line.totalQuantity}</span>
                    </td>
                    <td class="py-4 px-2 text-right">
                        <span class="text-sm font-medium text-slate-900">£${Number(line.price || 0).toFixed(2)}</span>
                    </td>
                    <td class="py-4 px-2 text-right">
                        <span class="text-sm font-bold text-blue-900">£${Number(line.lineTotal || 0).toFixed(2)}</span>
                    </td>
                    
                    <td class="py-4 px-2 text-center">
                        <button onclick="removeItem(${index})" class="text-red-400 hover:text-red-600 transition w-8 h-8 flex items-center justify-center rounded-lg hover:bg-red-50">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                       
                    </td>
                </tr>
        
    `).join('');

            document.getElementById('line-count').innerText = orderLines.length + " items";
        }
        
        function updateQty(index, change) {

            let item = orderLines[index];
            // 🔥 FORCE NUMBER (THIS IS THE FIX)
            item.qty = Number(item.qty);

            if (change < 0 && item.qty <= 1) {
                showToast('Minimum qty is 1');
                return;
            }

            item.qty += change;
            item.lineTotal = item.qty * item.price;

            // ✅ ONLY THIS API
            fetch('/order-item/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_item_id: item.id,
                    qty: item.qty
                })
            });

            renderOrderLines();
            updateSummary();
        }


        function updateStatus(status) {

            fetch('/order/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_id: orderId,
                    status: status
                })
            })
            .then(() => showToast('Status Updated ✅'));
        }
        function setQty(index, value) {

            let item = orderLines[index];

            let newQty = parseInt(value) || 5;
            if (newQty < 5) newQty = 5;

            item.qty = newQty;
            item.lineTotal = item.qty * item.price;

            // ✅ DB update
            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    cart_id: item.id,
                    qty: item.qty
                })
            });

            renderOrderLines();
            updateSummary();
        }

        // ✅ remove item
        function removeItem(index) {

            let item = orderLines[index];

            fetch('/order-item/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_item_id: item.id
                })
            })
            .then(res => res.json())
            .then(data => {

                if (data.success) {

                    orderLines.splice(index, 1);

                    renderOrderLines();
                    updateSummary();

                    showToast('Item removed ✅');
                }

            });
        }


        // ✅ summary
        function updateSummary() {

            let total = 0;
            let qty = 0;

            orderLines.forEach(item => {
                total += item.lineTotal;
                qty += item.qty;
            });

            document.getElementById('subtotal').innerText = "£" + total;
            document.getElementById('grand-total').innerText = "£" + total;
            document.getElementById('total-items').innerText = qty + " items";

            // enable button
            document.getElementById('submit-btn').disabled = orderLines.length === 0;
        }


        // ✅ place order
        function submitOrder() {

            fetch('/place-order', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(() => {
                    alert("Order Placed ✅");
                    window.location.href = "/customer/orders";
                })
                .catch(() => {
                    alert("Error ❌");
                });

        }


        // ✅ page load
        document.addEventListener('DOMContentLoaded', () => {

            renderOrderLines();
            updateSummary();

        });
        function searchProducts(query) {

            const dropdown = document.getElementById('product-dropdown');

            if (!query) {
                dropdown.classList.remove('active');
                dropdown.innerHTML = '';
                return;
            }

            fetch(`/products/search?q=${query}`)
                .then(res => res.json())
                .then(products => {

                    if (products.length === 0) {
                        dropdown.innerHTML = `<div class="p-3 text-sm text-slate-500">No products found</div>`;
                        dropdown.classList.add('active');
                        return;
                    }

                    dropdown.innerHTML = products.map(p => `
                <div class="product-item flex items-center justify-between">

                    <div class="flex items-center gap-3">
                        <img src="/${p.image}" class="w-10 h-10 object-cover rounded-lg"/>
                        <div>
                            <p class="text-sm font-medium">${p.title}</p>
                            <p class="text-xs text-slate-500">${p.sku_code}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold">£${p.price}</span>
                        <button onclick="quickAdd(${p.id})"
                            class="px-4 py-2 bg-blue-900 text-white text-xs rounded-lg hover:bg-blue-800">
                           + Add
                        </button>
                    </div>

                </div>
            `).join('');

                    dropdown.classList.add('active');
                });
        }

        // function quickAdd(productId) {

        //     fetch('/cart/add', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         body: JSON.stringify({
        //             product_id: productId,
        //             quantity: 5 // default MOQ
        //         })
        //     })
        //     .then(res => res.json())
        //     .then(data => {

        //             if (data.success) {
        //                 window.location.reload();
        //                 showToast('Added to cart ✅');

        //                 // OPTIONAL: reload lines
        //                 location.reload(); // ya dynamic add kar sakte ho
        //             }

        //     });
        
        // }

        function quickAdd(productId) {

            fetch('/order-item/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_id: orderId,
                    product_id: productId,
                    quantity: 5
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // showToast('Item added to order ✅');

                    // better UX (no reload)
                    location.reload(); 
                }
            });
        }

        document.addEventListener('click', function (e) {

            if (!e.target.closest('#product-search')) {
                document.getElementById('product-dropdown').classList.remove('active');
            }

        });
    </script>
</body>

</html>