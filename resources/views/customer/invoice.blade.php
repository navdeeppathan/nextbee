@extends('customer.dashboard')

@section('page-title', 'Invoice')

@section('content')

    <style>
        @media print {

            .sidebar,
            .topbar,
            .no-print {
                display: none !important;
            }

            .main-content {
                margin: 0 !important;
                padding: 0 !important;
            }

            .inv-wrap {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>

    <div class="inv-wrap card" style="padding: 32px; margin: 0 auto;">

        {{-- HEADER --}}
        <div
            style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:28px; padding-bottom:24px; border-bottom:1px solid #e2e8f0;">
            <div>
                <div
                    style="width:36px;height:36px;background:linear-gradient(135deg,#1e40af,#3b82f6);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:8px;">
                    <svg width="16" height="16" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div style="font-size:17px;font-weight:600;color:#0f172a;">Metro Wholesale</div>
                <div style="font-size:12px;color:#64748b;margin-top:2px;">B2B Portal · Wholesale Management</div>
            </div>
            <div style="text-align:right;">
                <div style="font-size:24px;font-weight:700;color:#0f172a;">Invoice</div>
                <div style="font-size:13px;color:#64748b;">INV-{{ $payment->id }}</div>
                <span class="pill pill-green" style="margin-top:8px;display:inline-flex;">
                    <span class="pill-dot"></span>
                    {{ ucfirst($payment->status ?? 'Paid') }}
                </span>
            </div>
        </div>

        {{-- META INFO --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:28px;">
            <div style="background:#f8fafc;border-radius:10px;padding:14px 16px;">
                <div
                    style="font-size:10px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;">
                    Bill To</div>
                <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
                    <span style="font-size:12px;color:#64748b;">Customer</span>
                    <span style="font-size:12px;font-weight:600;color:#0f172a;">{{ Auth::user()->name }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
                    <span style="font-size:12px;color:#64748b;">Email</span>
                    <span style="font-size:12px;font-weight:600;color:#0f172a;">{{ Auth::user()->email }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;">
                    <span style="font-size:12px;color:#64748b;">Role</span>
                    <span style="font-size:12px;font-weight:600;color:#0f172a;">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </div>
            <div style="background:#f8fafc;border-radius:10px;padding:14px 16px;">
                <div
                    style="font-size:10px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;">
                    Order Details</div>
                <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
                    <span style="font-size:12px;color:#64748b;">Order ID</span>
                    <span style="font-size:12px;font-weight:600;color:#0f172a;">#{{ $order->id }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
                    <span style="font-size:12px;color:#64748b;">Date</span>
                    <span
                        style="font-size:12px;font-weight:600;color:#0f172a;">{{ $payment->created_at->format('d M Y') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;">
                    <span style="font-size:12px;color:#64748b;">Payment Method</span>
                    <span style="font-size:12px;font-weight:600;color:#0f172a;">{{ ucfirst($payment->method) }}</span>
                </div>
            </div>
        </div>

        {{-- ITEMS TABLE --}}
        <div style="border-radius:12px;border:1px solid #e2e8f0;overflow:hidden;margin-bottom:20px;">
            <table class="data-table" style="table-layout:fixed;">
                <thead>
                    <tr>
                        <th style="width:100px;">Image</th>
                        <th>Product</th>
                        <th style="text-align:center;width:80px;">Qty</th>
                        <th style="text-align:right;width:110px;">Unit Price</th>
                        <th style="text-align:right;width:120px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <img src="/{{ $item->product->image ?? 'default.png' }}"
                                    style="width:100px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                            </td>
                            <td>
                                <div style="font-size:13px;font-weight:600;color:#0f172a;">
                                    {{ $item->product->title ?? 'Product' }}</div>
                                <div style="font-size:11px;color:#64748b;margin-top:2px;">
                                    SKU-{{ str_pad($item->product_id, 3, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td style="text-align:center;">{{ $item->quantity }}</td>
                            <td style="text-align:right;">£{{ number_format($item->price, 2) }}</td>
                            <td style="text-align:right;font-weight:600;">
                                £{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- TOTALS --}}
        <div style="display:flex;justify-content:flex-end;margin-bottom:24px;">
            <div style="min-width:240px;">
                <div style="display:flex;justify-content:space-between;padding:6px 0;font-size:13px;color:#64748b;">
                    <span>Subtotal</span><span>£{{ number_format($order->total_price, 2) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding:6px 0;font-size:13px;color:#64748b;">
                    <span>VAT (0%)</span><span>£0.00</span>
                </div>
                <div
                    style="display:flex;justify-content:space-between;padding:12px 0 0;margin-top:8px;border-top:1px solid #e2e8f0;font-size:16px;font-weight:700;color:#0f172a;">
                    <span>Total</span><span>£{{ number_format($order->total_price, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- NOTE --}}
        <div
            style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:12px 16px;margin-bottom:24px;font-size:12px;color:#1e40af;">
            Thank you for your order. For any queries, please contact our support team.
        </div>

        {{-- BUTTONS --}}
        <div style="display:flex;gap:10px;" class="no-print">
            <a href="{{ url()->previous() }}"
                style="display:inline-flex;align-items:center;gap:7px;padding:9px 18px;background:transparent;color:#64748b;border:1px solid #e2e8f0;border-radius:9px;font-size:13px;font-weight:500;text-decoration:none;margin-right:auto;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
                Back
            </a>
            <button onclick="window.print()"
                style="display:inline-flex;align-items:center;gap:7px;padding:9px 18px;background:#059669;color:#fff;border:none;border-radius:9px;font-size:13px;font-weight:500;cursor:pointer;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="6 9 6 2 18 2 18 9" />
                    <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />
                    <rect x="6" y="14" width="12" height="8" />
                </svg>
                Print
            </button>
            <button onclick="window.print()"
                style="display:inline-flex;align-items:center;gap:7px;padding:9px 18px;background:#1e40af;color:#fff;border:none;border-radius:9px;font-size:13px;font-weight:500;cursor:pointer;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
                Download PDF
            </button>
        </div>

    </div>

@endsection