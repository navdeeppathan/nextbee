@extends('SalesRep.layouts.app')

@section('content')
<div class="p-6 bg-slate-100 min-h-screen">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">
            Customer Details
        </h1>
        <p class="text-sm text-slate-500">
            Complete overview of customer profile
        </p>
    </div>

    <!-- MAIN CARD -->
    <div class="card p-6 customer-tier-gold">

        <div class="flex flex-col lg:flex-row gap-6 justify-between">

            <!-- LEFT -->
            <div class="flex-1">

                <!-- TOP -->
                <div class="flex items-start gap-4 mb-6">

                    <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center text-3xl border-2 border-amber-200">
                        🏪
                    </div>

                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h2 class="text-xl font-bold text-slate-900">
                                {{ $customer->business_name }}
                            </h2>

                            <span class="px-2 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded">
                                {{ strtoupper($customer->tier ?? 'GOLD') }}
                            </span>

                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded">
                                {{ strtoupper($customer->status) }}
                            </span>
                        </div>

                        <p class="text-sm text-slate-500">
                            {{ $customer->business_type }} • 
                            CUST-{{ str_pad($customer->id, 3, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                </div>

                <!-- STATS -->
               <div class="grid md:grid-cols-3 gap-4 mb-6">

                    <!-- Monthly Average -->
                    <div class="p-4 bg-white rounded-lg border">
                        <p class="text-xs text-slate-500 uppercase">Monthly Average</p>
                        <p class="text-lg font-bold">
                         {{$monthlyAverageOrder}}
                        </p>
                    </div>

                    <!-- Order Frequency -->
                    <div class="p-4 bg-white rounded-lg border">
                        <p class="text-xs text-slate-500 uppercase">Order Frequency</p>
                        <p class="text-lg font-bold">
                            {{ $orderFrequency ?? 0 }}
                        </p>
                    </div>

                    <!-- Last Order -->
                    <div class="p-4 bg-white rounded-lg border">
                        <p class="text-xs text-slate-500 uppercase">Last Order</p>
                        <p class="text-lg font-bold">
                            {{ $lastOrder ? \Carbon\Carbon::parse($lastOrder->created_at)->format('d M Y') : '------' }}
                        </p>
                    </div>

                </div>

                <!-- DETAILS GRID -->
                <div class="grid md:grid-cols-2 gap-4 text-sm">

                    <div class="p-4 bg-white rounded-lg border">
                        <p class="text-slate-500">Primary Contact</p>
                        <p class="font-semibold">{{ $customer->primary_contact_name }}</p>
                    </div>

                    <div class="p-4 bg-white rounded-lg border">
                        <p class="text-slate-500">Phone</p>
                        <p class="font-semibold">{{ $customer->phone }}</p>
                    </div>

                    <div class="p-4 bg-white rounded-lg border">
                        <p class="text-slate-500">Email</p>
                        <p class="font-semibold">{{ $customer->email }}</p>
                    </div>

                    <div class="p-4 bg-white rounded-lg border">
                        <p class="text-slate-500">Business Type</p>
                        <p class="font-semibold">{{ $customer->business_type }}</p>
                    </div>

                    <div class="p-4 bg-white rounded-lg border md:col-span-2">
                        <p class="text-slate-500">Delivery Address</p>
                        <p class="font-semibold">{{ $customer->delivery_address }}</p>
                    </div>
                    <!-- Credit Limit -->
                    <div class="p-4 bg-white rounded-lg border">
                        <p class="text-slate-500">Credit Limit</p>
                        <p class="font-semibold">
                            ₹{{ number_format($customer->credit_limit ?? 0, 0) }}
                        </p>
                    </div>

                    <!-- Invoice Payment Days -->
                    <div class="p-4 bg-white rounded-lg border">
                        <p class="text-slate-500">Invoice Pay Days</p>
                        <p class="font-semibold">
                            {{ $customer->invoice_pay_days ?? 0 }} days
                        </p>
                    </div>

                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Order History</h3>

                    <div class="bg-white rounded-xl border overflow-hidden">

                        <table class="w-full text-sm">
                            <thead class="bg-slate-100 text-slate-600">
                                <tr>
                                    <th class="p-3 text-left">Order ID</th>
                                    <th class="p-3 text-left">Date</th>
                                    <th class="p-3 text-left">Items</th>
                                    <th class="p-3 text-left">Total</th>
                                    <th class="p-3 text-left">Payment</th>
                                    <th class="p-3 text-left">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($orders as $order)
                                    <tr class="border-t">

                                        <td class="p-3 font-semibold">
                                            #{{ $order->id }}
                                        </td>

                                        <td class="p-3">
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                                        </td>

                                        <td class="p-3">
                                            {{ $order->items->count() }} items
                                        </td>

                                        <td class="p-3 font-bold">
                                            ₹{{ number_format($order->total_price, 2) }}
                                        </td>

                                        <td class="p-3">
                                            @if($order->payment)
                                                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700 font-semibold">
                                                    {{ strtoupper($order->payment->status) }}
                                                </span>
                                            @else
                                                <span class="text-slate-400 text-xs">N/A</span>
                                            @endif
                                        </td>

                                        <td class="p-3">
                                            <span class="px-2 py-1 text-xs rounded bg-emerald-100 text-emerald-700 font-semibold">
                                                {{ strtoupper($order->status) }}
                                            </span>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-4 text-center text-slate-400">
                                            No orders found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="lg:w-80 space-y-4">

                <!-- DELIVERY DAYS -->
                <div class="p-4 bg-white rounded-xl border">
                    <p class="text-xs font-bold text-slate-500 uppercase mb-3">
                        Delivery Schedule
                    </p>

                    <div class="flex gap-2 flex-wrap">
                        @foreach($customer->preferred_delivery_days ?? [] as $day)
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-bold">
                                {{ $day }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <p class="text-sm text-slate-500">
                    Current: 
                    {{ optional(\App\Models\User::find($customer->sales_assigned))->name ?? 'Not Assigned' }}
                </p>

                <form action="{{ route('customer.assign.sales', $customer->id) }}" method="POST">
                    @csrf

                    <select name="sales_assigned"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">

                        <option value="">Select Sales Rep</option>

                        @foreach(\App\Models\User::where('role','sale_rep')->get() as $rep)
                            <option value="{{ $rep->id }}"
                                {{ $customer->sales_assigned == $rep->id ? 'selected' : '' }}>
                                {{ $rep->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="w-full mt-2 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold">
                        Update Sales Rep
                    </button>
                </form>

                <!-- ACTIONS -->
                <div class="p-4 bg-white rounded-xl border space-y-3">

                    <!-- Send Price List -->
                    <form action="{{ route('send.pricelist', $customer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="file" name="pricelist"
                            class="block w-full text-sm border border-slate-300 rounded-lg p-2"
                            required>

                        <button type="submit"
                            class="w-full mt-2 py-2 bg-green-600 text-white rounded-lg text-sm font-semibold hover:bg-green-700">
                            Upload & Send Price List
                        </button>
                    </form>

                    <!-- Back -->
                    <a href="{{ url()->previous() }}"
                        class="block text-center py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-semibold">
                        Back
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection