@extends('customer.dashboard')

@section('page-title', 'Payment History')
@section('page-subtitle', 'All your transactions and billing records.')

@section('content')





    <div class="card">
        <div
            style="padding: 18px 20px 14px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between;">
            <div style="font-size:14px; font-weight:700; color:#0f172a;">All Transactions</div>
            <div style="display:flex; align-items:center; gap:10px;">
                <span class="pill pill-blue" style="font-size:11px;"><span class="pill-dot"></span>{{ $totalTransactions }}
                    transactions</span>
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
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                        <!-- <th>Payment</th> -->

                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $p)
                        <tr>
                            <td style="font-weight:700;">#{{ $p->id }}</td>

                            <td>
                                <a href="/customer/orders" style="color:#1e40af;">
                                    #{{ $p->order_id }}
                                </a>
                            </td>


                            <td style="font-weight:700;">£ {{ $p->amount }}</td>
                            <td style="font-weight:700;"> {{ $p->method }}</td>

                            <td>{{ $p->created_at->format('d M Y') }}</td>

                            <td>
                                @if($p->order->payment_status == 'pending')
                                    <span class="pill pill-yellow">Pending</span>
                                @elseif($p->order->payment_status == 'partial')
                                    <span class="pill pill-blue">Partial Payment</span>
                                @elseif($p->order->payment_status == 'full')
                                    <span class="pill pill-green">Full Payment</span>
                                @endif
                            </td>

                            <td>
                                <a href="/invoice/{{ $p->id }}">
                                    <button class="px-3 py-1 bg-blue-900 text-white rounded">
                                        View
                                    </button>
                                </a>
                            </td>
                        </tr>

                    @empty
                        <!-- 🔥 NO DATA ROW -->
                        <tr>
                            <td colspan="7" style="text-align:center; padding:30px;">
                                <div style="color:#64748b; font-size:14px;">
                                    ❌ No Transactions Found
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding:15px;">
                {{ $payments->links() }}
            </div>
        </div>

    </div>

    <div id="paymentModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:#00000080; z-index:999;">

        <div
            style="background:white; padding:24px; width:360px; margin:80px auto; border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,0.2);">

            <h3 style="font-size:18px; font-weight:700; margin-bottom:10px;">💳 Make Payment</h3>

            <!-- SUMMARY -->
            <div style="background:#f8fafc; padding:12px; border-radius:10px; margin-bottom:12px;">
                <div>Total: £<span id="totalAmount">0</span></div>
                <div>Paid: £<span id="paidAmount">0</span></div>
                <div style="font-weight:700; color:#dc2626;">
                    Remaining: £<span id="remainingText">0</span>
                </div>
            </div>

            <!-- INPUT -->
            <input type="number" id="pay_amount" placeholder="Enter amount"
                style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; margin-bottom:12px;">

            <!-- BUTTONS -->
            <div style="display:flex; gap:10px;">
                <button onclick="submitPayment()"
                    style="flex:1; background:#1e40af; color:white; padding:10px; border-radius:8px;">
                    Pay Now
                </button>

                <button onclick="closeModal()" style="flex:1; background:#e2e8f0; padding:10px; border-radius:8px;">
                    Cancel
                </button>
            </div>

        </div>
    </div>
    <script>
        let currentOrderId = null;
        let remainingAmount = 0;

        function openPaymentModal(orderId) {
            console.log(orderId);
            currentOrderId = orderId;

            fetch('/order-remaining/' + orderId)
                .then(res => res.json())
                .then(data => {

                    document.getElementById('totalAmount').innerText = data.total;
                    document.getElementById('paidAmount').innerText = data.paid;
                    document.getElementById('remainingText').innerText = data.remaining;

                    remainingAmount = data.remaining;

                    // document.getElementById('pay_amount').value = data.remaining;
                    if (data.remaining > 0) {
                        document.getElementById('pay_amount').value = data.remaining;
                    } // auto fill
                });

            document.getElementById('paymentModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('paymentModal').style.display = 'none';
        }

        function submitPayment() {

            let amount = parseFloat(document.getElementById('pay_amount').value);


            if (!amount || amount <= 0) {
                alert("Enter valid amount ❌");
                return;
            }

            if (amount > remainingAmount) {
                alert("Amount exceeds remaining ❌");
                return;
            }

            fetch('/add-payment', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: new URLSearchParams({
                    order_id: currentOrderId,
                    amount: amount,
                    method: 'UPI'
                })
            })
                .then(() => {
                    alert("Payment Successful ✅");
                    location.reload();
                });
        }
    </script>

@endsection