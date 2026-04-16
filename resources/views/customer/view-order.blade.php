@extends('customer.dashboard')

@section('page-title', 'My Profile')
@section('page-subtitle', 'View and manage your account information.')

@section('content')
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

        .tracking-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .tracking-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80px;
            position: relative;
            z-index: 2;
        }

        .step {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: 0.3s;
        }

        .step.active {
            background: #1e40af;
            color: #fff;
        }

        .line {
            flex: 1;
            height: 4px;
            background: #e2e8f0;
            margin: 0 8px;
            border-radius: 2px;
            position: relative;
            top: -18px;
            /* 🔥 PERFECT ALIGN */
            z-index: 1;
            transition: 0.3s;
        }

        .line.active {
            background: #1e40af;
        }

        .tracking-item span {
            font-size: 12px;
            margin-top: 8px;
            text-align: center;
        }
    </style>


    <script>
        let orderLines = @json($orderData); // ✅ DB data
    </script>

    <div class="bg-slate-50">



        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="font-display text-3xl font-bold text-slate-900"> Order View</h1>
                        <p class="text-slate-500 mt-1">View a new sales order for your business</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <!-- <span class="text-sm text-slate-500">Order #:</span> -->
                        <a href="/customer/orders">

                            <!-- <span class="font-mono font-semibold text-blue-900 bg-blue-50 px-3 py-1 rounded-lg"> Back</span> -->
                            <button
                                class="px-4 py-2 bg-slate-800 text-white text-sm font-medium rounded-lg hover:bg-slate-700 transition">
                                Back
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">

                <h2 class="font-semibold text-lg mb-6">Order Tracking</h2>

                @php
                    $status = strtolower(trim($order->status));

                    // 🔥 IMPORTANT FIX (space normalize)
                    $status = str_replace(['  '], ' ', $status);

                    $steps = [
                        'created' => 1,
                        'accepted' => 2,
                        'ready for delivery' => 3,
                        'out for delivery' => 4,
                        'delivered' => 5,
                    ];

                    $currentStep = $steps[$status] ?? 1;
                @endphp

                <div class="tracking-wrapper">

                    <!-- STEP 1 -->
                    <div class="tracking-item">
                        <div class="step {{ $currentStep >= 1 ? 'active' : '' }}">1</div>
                        <span>Created</span>
                    </div>

                    <div class="line {{ $currentStep >= 1 ? 'active' : '' }}"></div>

                    <!-- STEP 2 -->
                    <div class="tracking-item">
                        <div class="step {{ $currentStep >= 2 ? 'active' : '' }}">2</div>
                        <span>Accepted</span>
                    </div>

                    <div class="line {{ $currentStep >= 2 ? 'active' : '' }}"></div>

                    <!-- STEP 3 -->
                    <div class="tracking-item">
                        <div class="step {{ $currentStep >= 3 ? 'active' : '' }}">3</div>
                        <span>Ready For Delivery</span>
                    </div>

                    <div class="line {{ $currentStep >= 3 ? 'active' : '' }}"></div>

                    <!-- STEP 4 -->
                    <div class="tracking-item">
                        <div class="step {{ $currentStep >= 4 ? 'active' : '' }}">4</div>
                        <span>Out For Delivery</span>
                    </div>

                    <div class="line {{ $currentStep >= 4 ? 'active' : '' }}"></div>

                    <!-- STEP 5 -->
                    <div class="tracking-item">
                        <div class="step {{ $currentStep >= 5 ? 'active' : '' }}">5</div>
                        <span>Delivered</span>
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
                                <input type="text" value="{{ Auth::user()->name }}"
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
                                <input type="text" value="{{ Auth::user()->email }}"
                                    class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none bg-slate-50"
                                    readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Required Delivery Date</label>
                                <input type="date" id="delivery-date"
                                    class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none">
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
                                            Unit Price</th>
                                        <th
                                            class="text-right py-3 px-2 text-xs font-semibold text-slate-500 uppercase w-28">
                                            Line Total</th>

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
                                <label class="block text-sm font-medium text-slate-700 mb-2">Delivery Instructions</label>
                                <textarea rows="2" placeholder="e.g., Deliver to rear entrance, use loading bay..."
                                    class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none resize-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Internal Notes</label>
                                <textarea rows="2" placeholder="Notes for your team (not visible to customer)..."
                                    class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:border-blue-900 focus:outline-none resize-none"></textarea>
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

                            <!-- Credit Limit Info -->
                            <div class="mt-4 p-3 bg-slate-50 rounded-lg">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-slate-600">Credit Limit</span>
                                    <span class="font-medium text-slate-900">£25,000</span>
                                </div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-slate-600">Available</span>
                                    <span class="font-medium text-green-600" id="credit-available">£25,000</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2 mt-2">
                                    <div id="credit-bar" class="bg-green-500 h-2 rounded-full transition-all"
                                        style="width: 0%"></div>
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

                tbody.innerHTML = orderLines.map((line) => `
                    <tr class="order-line border-b border-slate-100 animate-slide-in">

                        <td class="py-4 px-2">
                            <div>
                                <p class="font-medium text-slate-900">${line.name}</p>
                                <p class="text-xs text-slate-500">${line.sku} • MOQ: ${line.moq || 1}</p>
                            </div>
                        </td>

                        <td class="py-4 px-2 text-center">
                            <span class="font-semibold">${line.qty}</span>
                        </td>

                        <td class="py-4 px-2 text-right">
                            <span class="text-sm font-medium text-slate-900">
                                £${(line.price || 0).toFixed(2)}
                            </span>
                        </td>

                        <td class="py-4 px-2 text-right">
                            <span class="text-sm font-bold text-blue-900">
                                £${(line.lineTotal || 0).toFixed(2)}
                            </span>
                        </td>

                    </tr>
                    `).join('');
                document.getElementById('line-count').innerText = orderLines.length + " items";
            }

            document.addEventListener('DOMContentLoaded', () => {
                renderOrderLines();
                updateSummary();
            });
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
            }

        </script>
    </div>

@endsection