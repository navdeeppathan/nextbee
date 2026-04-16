@extends('customer.dashboard')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of your account')

@section('content')
    <style>
        .tab-btn {
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #475569;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn:hover {
            background: #e2e8f0;
        }

        .tab-btn.active {
            background: #1e40af;
            color: white;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }
    </style>


    {{-- ── Stats ── --}}
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
        <div class="stat-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                <div class="stat-label">Total Orders</div>
                <div
                    style="width:32px;height:32px;background:#eff6ff;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg width="15" height="15" fill="none" stroke="#1e40af" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 7H4a1 1 0 00-1 1v10a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1z" />
                        <path d="M16 3H8l-1 4h10z" />
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $totalOrders }}</div>
        </div>
        <div class="stat-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                <div class="stat-label">Total Spent</div>
                <div
                    style="width:32px;height:32px;background:#f0fdf4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg width="15" height="15" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </div>
            </div>
            <div class="stat-value" style="color:#059669;">£ {{ $totalSpent }}</div>
        </div>
        <div class="stat-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                <div class="stat-label">Current Sales Orders</div>
                <div
                    style="width:32px;height:32px;background:#dbeafe;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg width="15" height="15" fill="none" stroke="#1e40af" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                <div class="stat-value" style="color:#1e40af;">
                    {{ $cartCount }}
                </div>
                <div class="stat-value" style="color:#1e40af;">
                    £{{ $cartTotal }}
                </div>
            </div>
        </div>

    </div>



    {{-- ── Orders Table ── --}}
    <div class="card">

        {{-- 🔥 Tabs --}}
        <div style="margin-bottom:20px;">

            <div style="display:flex; gap:8px; padding:6px; border-radius:12px; width:fit-content;">

                <button onclick="showTab('orders')" id="ordersTab" class="tab-btn active">
                    📦 Active Orders
                </button>

                <button onclick="showTab('drafts')" id="draftsTab" class="tab-btn">
                    📝 Orders
                </button>

            </div>

        </div>

        {{-- ================= ORDERS TABLE ================= --}}
        <div id="ordersTable" style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <!-- <th>Product</th> -->
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Payment</th>
                        <th>Status</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                #{{ $order->parent_order_id  }}
                            </td>



                            <td>

                                {{ $order->items->sum('quantity') }}

                            </td>

                            <td>£{{ $order->total_price }}</td>

                            <td>{{ $order->created_at->format('d M Y') }}</td>

                            {{-- ✅ PAYMENT STATUS --}}
                            <td>


                                @if($order->payment_status == 'pending')
                                    <span class="pill pill-yellow">Pending</span>

                                @elseif($order->payment_status == 'partial')
                                    <span class="pill pill-blue">Partial Payment</span>

                                @elseif($order->payment_status == 'full')
                                    <span class="pill pill-green">Full Payment</span>
                                @endif
                            </td>

                            {{-- ✅ ORDER STATUS --}}
                            <td>
                                <span class="pill pill-blue">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                @if(in_array($order->status, ['draft', 'created', 'accepted']))
                                    <a href="{{ url('/orderstatus/' . $order->id) }}"
                                        class="px-3 py-1 bg-blue-900 text-white rounded-lg text-xs">
                                        Edit
                                    </a>
                                @else
                                    <span class="text-slate-400 text-xs">No Action</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ================= DRAFT TABLE ================= --}}
        <div id="draftTable" style="display:none; overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <!-- <th>Product</th> -->
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Payment</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($draftOrders as $order)
                        <tr>
                            <td>
                                #{{ $order->parent_order_id ?? $order->id }}
                            </td>

                            <!-- <td>
                                                                @foreach($order->items as $item)
                                                                    {{ $item->product->title ?? 'Product' }} <br>
                                                                @endforeach
                                                            </td> -->

                            <td>
                                {{ $order->items->sum('quantity') }}

                            </td>

                            <td>£{{ $order->total_price }}</td>

                            <td>{{ $order->created_at->format('d M Y') }}</td>

                            <td>


                                @if($order->payment_status == 'pending')
                                    <span class="pill pill-yellow">Pending</span>

                                @elseif($order->payment_status == 'partial')
                                    <span class="pill pill-blue">Partial Payment</span>

                                @elseif($order->payment_status == 'full')
                                    <span class="pill pill-green">Full Payment</span>
                                @endif
                            </td>

                            <td>
                                <span class="pill pill-yellow">Delivered</span>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    {{-- 🔥 TAB SWITCH SCRIPT --}}
    <script>
        function showTab(tab) {

            document.getElementById('ordersTable').style.display =
                tab === 'orders' ? 'block' : 'none';

            document.getElementById('draftTable').style.display =
                tab === 'drafts' ? 'block' : 'none';

            document.getElementById('ordersTab').classList.toggle('active', tab === 'orders');
            document.getElementById('draftsTab').classList.toggle('active', tab === 'drafts');
        }
    </script>

@endsection