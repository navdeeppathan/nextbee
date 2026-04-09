@extends('customer.dashboard')

@section('page-title', 'Payment History')
@section('page-subtitle', 'All your transactions and billing records.')

@section('content')

{{-- ── Payment Stats ── --}}
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">

    <div style="background: linear-gradient(135deg, #0f172a, #1e3a5f); border-radius: 14px; padding: 22px 20px; position:relative; overflow:hidden;">
        <div style="position:absolute;inset:0;background:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/svg%3E');"></div>
        <div style="position:relative;">
            <div style="font-size:11px; font-weight:600; color:rgba(255,255,255,0.4); text-transform:uppercase; letter-spacing:0.07em; margin-bottom:10px;">Total Paid (All Time)</div>
            <div style="font-size:28px; font-weight:700; color:#fff;">₹8,400</div>
            <div style="font-size:11px; color:rgba(212,175,55,0.7); margin-top:6px; display:flex; align-items:center; gap:4px;">
                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                6 completed payments
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <div class="stat-label">This Month</div>
            <div style="width:32px;height:32px;background:#f0fdf4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <svg width="15" height="15" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M8 12l3 3 5-5"/></svg>
            </div>
        </div>
        <div class="stat-value" style="color:#059669;">₹1,200</div>
        <div class="stat-trend trend-up">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
            2 payments made
        </div>
    </div>

    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <div class="stat-label">Outstanding Dues</div>
            <div style="width:32px;height:32px;background:#fef3c7;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <svg width="15" height="15" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
        </div>
        <div class="stat-value">₹800</div>
        <div class="stat-trend" style="color:#d97706;">1 pending payment</div>
    </div>

</div>

{{-- ── Payment Methods ── --}}
<div class="card" style="margin-bottom: 20px;">
    <div style="padding: 18px 20px 14px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; gap:10px;">
        <div style="width:32px;height:32px;background:#eff6ff;border-radius:8px;display:flex;align-items:center;justify-content:center;">
            <svg width="15" height="15" fill="none" stroke="#1e40af" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
        </div>
        <span style="font-size:14px; font-weight:700; color:#0f172a;">Preferred Payment Methods</span>
    </div>
    <div style="padding:16px 20px; display:flex; gap:12px; flex-wrap:wrap;">
        <div style="background:#f8fafc; border:1.5px solid #1e40af; border-radius:10px; padding:12px 18px; display:flex; align-items:center; gap:10px; min-width:160px;">
            <div style="width:32px;height:32px;background:#dbeafe;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#1e40af;">UPI</div>
            <div>
                <div style="font-size:12px; font-weight:700; color:#0f172a;">UPI</div>
                <div style="font-size:11px; color:#94a3b8;">arjun@upi</div>
            </div>
        </div>
        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:12px 18px; display:flex; align-items:center; gap:10px; min-width:160px;">
            <div style="width:32px;height:32px;background:#f1f5f9;border-radius:7px;display:flex;align-items:center;justify-content:center;">
                <svg width="15" height="15" fill="none" stroke="#64748b" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
            </div>
            <div>
                <div style="font-size:12px; font-weight:700; color:#0f172a;">Debit Card</div>
                <div style="font-size:11px; color:#94a3b8;">**** 4321</div>
            </div>
        </div>
        <div style="background:#f8fafc; border:1px dashed #e2e8f0; border-radius:10px; padding:12px 18px; display:flex; align-items:center; gap:8px; cursor:pointer; min-width:120px;">
            <svg width="14" height="14" fill="none" stroke="#94a3b8" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span style="font-size:12px; font-weight:600; color:#94a3b8;">Add Method</span>
        </div>
    </div>
</div>

{{-- ── Transactions Table ── --}}
<div class="card">
    <div style="padding: 18px 20px 14px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between;">
        <div style="font-size:14px; font-weight:700; color:#0f172a;">All Transactions</div>
        <div style="display:flex; align-items:center; gap:10px;">
            <span class="pill pill-blue" style="font-size:11px;"><span class="pill-dot"></span>6 transactions</span>
            <button style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:6px 12px; font-size:11px; font-weight:600; color:#64748b; cursor:pointer; display:flex; align-items:center; gap:5px;">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
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
                </tr>
            </thead>
            <tbody>
                @php
                $payments = [
                    ['pay_id'=>'#5001','order_id'=>'#101','product'=>'Milk Pack',     'method'=>'UPI',          'amount'=>'₹1,200','date'=>'Apr 6, 2026',  'status'=>'Paid',     'cls'=>'pill-green'],
                    ['pay_id'=>'#4998','order_id'=>'#98', 'product'=>'Cheese Blocks', 'method'=>'Net Banking',  'amount'=>'₹2,400','date'=>'Apr 1, 2026',  'status'=>'Paid',     'cls'=>'pill-green'],
                    ['pay_id'=>'#4991','order_id'=>'#95', 'product'=>'Butter Pack',   'method'=>'UPI',          'amount'=>'₹800',  'date'=>'Mar 27, 2026', 'status'=>'Pending',  'cls'=>'pill-amber'],
                    ['pay_id'=>'#4984','order_id'=>'#91', 'product'=>'Yogurt × 6',   'method'=>'Debit Card',   'amount'=>'₹600',  'date'=>'Mar 20, 2026', 'status'=>'Paid',     'cls'=>'pill-green'],
                    ['pay_id'=>'#4977','order_id'=>'#88', 'product'=>'Paneer Block',  'method'=>'UPI',          'amount'=>'₹900',  'date'=>'Mar 14, 2026', 'status'=>'Paid',     'cls'=>'pill-green'],
                    ['pay_id'=>'#4970','order_id'=>'#85', 'product'=>'Cream × 4',    'method'=>'Debit Card',   'amount'=>'₹480',  'date'=>'Mar 8, 2026',  'status'=>'Refunded', 'cls'=>'pill-purple'],
                ];
                @endphp
                @foreach($payments as $p)
                <tr>
                    <td style="font-weight:700; color:#0f172a;">{{ $p['pay_id'] }}</td>
                    <td>
                        <a href="/customer/orders" style="color:#1e40af; text-decoration:none; font-weight:600; font-size:12px;">{{ $p['order_id'] }}</a>
                    </td>
                    <td style="font-weight:500;">{{ $p['product'] }}</td>
                    <td>
                        <div style="display:flex; align-items:center; gap:6px;">
                            <div style="width:24px;height:24px;background:#f1f5f9;border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:700;color:#64748b;">
                                {{ strtoupper(substr($p['method'], 0, 2)) }}
                            </div>
                            <span style="font-size:12px; color:#334155;">{{ $p['method'] }}</span>
                        </div>
                    </td>
                    <td style="font-weight:700; color:#0f172a;">{{ $p['amount'] }}</td>
                    <td style="color:#94a3b8; font-size:12px;">{{ $p['date'] }}</td>
                    <td><span class="pill {{ $p['cls'] }}" style="font-size:11px;"><span class="pill-dot"></span>{{ $p['status'] }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Footer Summary --}}
    <div style="padding: 16px 20px; background:#f8fafc; border-top:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between; border-radius: 0 0 14px 14px;">
        <span style="font-size:12px; color:#64748b;">Showing 6 of 6 transactions</span>
        <div style="display:flex; align-items:center; gap:16px; font-size:12px; font-weight:600; color:#64748b;">
            Total Paid: <span style="color:#0f172a; font-size:14px;">₹8,400</span>
        </div>
    </div>
</div>

@endsection