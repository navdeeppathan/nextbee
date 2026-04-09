@extends('customer.dashboard')

@section('page-title', 'My Orders')
@section('page-subtitle', 'Track and manage all your orders.')

@section('content')

{{-- ── Stats ── --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <div class="stat-label">Total Orders</div>
            <div style="width:32px;height:32px;background:#eff6ff;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <svg width="15" height="15" fill="none" stroke="#1e40af" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7H4a1 1 0 00-1 1v10a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1z"/><path d="M16 3H8l-1 4h10z"/></svg>
            </div>
        </div>
        <div class="stat-value">14</div>
    </div>
    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <div class="stat-label">Delivered</div>
            <div style="width:32px;height:32px;background:#f0fdf4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <svg width="15" height="15" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>
        <div class="stat-value" style="color:#059669;">10</div>
    </div>
    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <div class="stat-label">In Progress</div>
            <div style="width:32px;height:32px;background:#dbeafe;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <svg width="15" height="15" fill="none" stroke="#1e40af" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
        </div>
        <div class="stat-value" style="color:#1e40af;">3</div>
    </div>
    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <div class="stat-label">Cancelled</div>
            <div style="width:32px;height:32px;background:#fee2e2;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <svg width="15" height="15" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            </div>
        </div>
        <div class="stat-value" style="color:#dc2626;">1</div>
    </div>
</div>

{{-- ── Filter Bar ── --}}
<div class="card" style="padding: 14px 20px; margin-bottom: 16px; display:flex; align-items:center; gap:10px;">
    <div style="font-size:12px; font-weight:600; color:#64748b;">Filter by:</div>
    @php
    $filters = ['All' => 'pill-blue', 'Delivered' => 'pill-green', 'In Transit' => 'pill-blue', 'Processing' => 'pill-amber', 'Cancelled' => 'pill-red'];
    $i = 0;
    @endphp
    @foreach($filters as $label => $cls)
    <span class="pill {{ $i===0 ? $cls : '' }}" style="{{ $i===0 ? '' : 'background:#f1f5f9;color:#64748b;' }} cursor:pointer; font-size:11px;">
        {{ $label }}
    </span>
    @php $i++; @endphp
    @endforeach
    <div style="margin-left:auto; display:flex; align-items:center; gap:8px;">
        <input type="text" placeholder="Search orders..." style="border:1px solid #e2e8f0; border-radius:8px; padding:7px 12px; font-size:12px; color:#334155; outline:none; width:200px;">
    </div>
</div>

{{-- ── Orders Table ── --}}
<div class="card">
    <div style="padding: 18px 20px 14px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between;">
        <div style="font-size:14px; font-weight:700; color:#0f172a;">All Orders</div>
        <span class="pill pill-blue" style="font-size:11px;"><span class="pill-dot"></span>14 total</span>
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
                @php
                $orders = [
                    ['id'=>'#101', 'product'=>'Milk Pack',     'qty'=>12, 'amount'=>'₹1,200', 'date'=>'Apr 6, 2026',  'payment'=>'Paid',    'pay_cls'=>'pill-green',  'status'=>'Delivered',  'cls'=>'pill-green'],
                    ['id'=>'#98',  'product'=>'Cheese Blocks', 'qty'=>5,  'amount'=>'₹2,400', 'date'=>'Apr 1, 2026',  'payment'=>'Paid',    'pay_cls'=>'pill-green',  'status'=>'Shipped',    'cls'=>'pill-blue'],
                    ['id'=>'#95',  'product'=>'Butter Pack',   'qty'=>8,  'amount'=>'₹800',   'date'=>'Mar 27, 2026', 'payment'=>'Pending', 'pay_cls'=>'pill-amber',  'status'=>'Processing', 'cls'=>'pill-amber'],
                    ['id'=>'#91',  'product'=>'Yogurt × 6',   'qty'=>6,  'amount'=>'₹600',   'date'=>'Mar 20, 2026', 'payment'=>'Paid',    'pay_cls'=>'pill-green',  'status'=>'Delivered',  'cls'=>'pill-green'],
                    ['id'=>'#88',  'product'=>'Paneer Block',  'qty'=>3,  'amount'=>'₹900',   'date'=>'Mar 14, 2026', 'payment'=>'Paid',    'pay_cls'=>'pill-green',  'status'=>'Delivered',  'cls'=>'pill-green'],
                    ['id'=>'#85',  'product'=>'Cream × 4',    'qty'=>4,  'amount'=>'₹480',   'date'=>'Mar 8, 2026',  'payment'=>'Refunded','pay_cls'=>'pill-purple', 'status'=>'Cancelled',  'cls'=>'pill-red'],
                    ['id'=>'#82',  'product'=>'Milk Pack',     'qty'=>12, 'amount'=>'₹1,200', 'date'=>'Mar 1, 2026',  'payment'=>'Paid',    'pay_cls'=>'pill-green',  'status'=>'Delivered',  'cls'=>'pill-green'],
                ];
                @endphp
                @foreach($orders as $order)
                <tr>
                    <td style="font-weight:700; color:#0f172a;">{{ $order['id'] }}</td>
                    <td style="font-weight:500;">{{ $order['product'] }}</td>
                    <td style="color:#64748b;">{{ $order['qty'] }} units</td>
                    <td style="font-weight:700; color:#0f172a;">{{ $order['amount'] }}</td>
                    <td style="color:#94a3b8;">{{ $order['date'] }}</td>
                    <td><span class="pill {{ $order['pay_cls'] }}" style="font-size:11px;"><span class="pill-dot"></span>{{ $order['payment'] }}</span></td>
                    <td><span class="pill {{ $order['cls'] }}" style="font-size:11px;"><span class="pill-dot"></span>{{ $order['status'] }}</span></td>
                    <td>
                        <button style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:7px; padding:5px 11px; font-size:11px; font-weight:600; color:#64748b; cursor:pointer;">
                            Details
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection