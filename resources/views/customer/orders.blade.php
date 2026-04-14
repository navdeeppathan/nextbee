@extends('customer.dashboard')

@section('page-title', 'My Orders')
@section('page-subtitle', 'Track and manage all your orders.')

@section('content')

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
                <div class="stat-label">Cart Items</div>
                <div
                    style="width:32px;height:32px;background:#dbeafe;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg width="15" height="15" fill="none" stroke="#1e40af" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </div>
            </div>
            <div class="stat-value" style="color:#1e40af;">{{ $cartCount }}</div>
        </div>

    </div>



    {{-- ── Orders Table ── --}}
    <div class="card">
        <div
            style="padding: 18px 20px 14px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between;">
            <div style="font-size:14px; font-weight:700; color:#0f172a;">All Orders</div>
            <!-- <span class="pill pill-blue" style="font-size:11px;"><span class="pill-dot"></span>14 total</span> -->
        </div>
        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                @foreach($order->items as $item)
                                    {{ $item->product->title ?? 'Product' }} <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach($order->items as $item)
                                    {{ $item->quantity }} <br>
                                @endforeach
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
                                @if($order->status == 'draft')
                                    <span class="pill pill-gray">Draft</span>

                                @elseif($order->status == 'created')
                                    <span class="pill pill-blue">Created</span>

                                @elseif($order->status == 'accepted')
                                    <span class="pill pill-purple">Accepted</span>

                                @elseif($order->status == 'ready for delivery')
                                    <span class="pill pill-yellow">Ready</span>

                                @elseif($order->status == 'out for delivery')
                                    <span class="pill pill-orange">Out for Delivery</span>

                                @elseif($order->status == 'delivered')
                                    <span class="pill pill-green">Delivered</span>

                                @elseif($order->status == 'cancel')
                                    <span class="pill pill-red">Cancelled</span>

                                @else
                                    <span class="pill pill-gray">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="/order/{{ $order->id }}">
                                    <button class="px-3 py-1 bg-blue-900 text-white rounded">
                                        View Order
                                    </button>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding:15px;">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

@endsection