@extends('customer.dashboard')

@section('page-title', 'Payment History')
@section('page-subtitle', 'All your transactions and billing records.')

@section('content')

   

   

    {{-- ── Transactions Table ── --}}
    <div class="card">
        <div
            style="padding: 18px 20px 14px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between;">
            <div style="font-size:14px; font-weight:700; color:#0f172a;">All Transactions</div>
            <div style="display:flex; align-items:center; gap:10px;">
                <span class="pill pill-blue" style="font-size:11px;"><span class="pill-dot"></span>6 transactions</span>
                <button
                    style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:6px 12px; font-size:11px; font-weight:600; color:#64748b; cursor:pointer; display:flex; align-items:center; gap:5px;">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" y1="15" x2="12" y2="3" />
                    </svg>
                    Export
                </button>
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Method</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $p)
                        <tr>
                            <td style="font-weight:700;">#{{ $p->id }}</td>

                            <td>
                                <a href="/customer/orders" style="color:#1e40af;">
                                    #{{ $p->order_id }}
                                </a>
                            </td>

                            <td>Order Payment</td>

                            <td>
                                <div style="display:flex; gap:6px;">
                                    <div
                                        style="width:24px;height:24px;background:#f1f5f9;border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:9px;">
                                        {{ strtoupper(substr($p->method, 0, 2)) }}
                                    </div>
                                    <span>{{ $p->method }}</span>
                                </div>
                            </td>

                            <td style="font-weight:700;">£ {{ $p->amount }}</td>

                            <td>{{ $p->created_at->format('d M Y') }}</td>

                            <td>
                                <span class="pill {{ $p->status == 'Paid' ? 'pill-green' : 'pill-amber' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td>
                                <a href="/invoice/{{ $p->id }}">
                                    <button class="px-3 py-1 bg-blue-900 text-white rounded">
                                        View
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding:15px;">
    {{ $payments->links() }}
</div>
        </div>
        
    </div>

@endsection