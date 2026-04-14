@extends('Inventory.layouts.app')

@section('content')
        <div class="p-6">
            <!-- Header Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total SKUs</div>
                        <span class="text-blue-600 text-xs font-semibold bg-blue-50 px-2 py-1 rounded">Live</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-900 font-display">{{$totalSkus}}</div>
                    <div class="text-xs text-slate-500 mt-1">Across {{ $categories }} categories</div>
                </div>
                <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Expiring Soon</div>
                        <span class="text-red-600 text-xs font-semibold bg-red-50 px-2 py-1 rounded">Alert</span>
                    </div>
                    <div class="text-3xl font-bold text-red-600 font-display">{{$expiringsoon}}</div>
                    <div class="text-xs text-slate-500 mt-1">Next 48 hours</div>
                </div>
                <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Today's Deliveries</div>
                        <span class="text-emerald-600 text-xs font-semibold bg-emerald-50 px-2 py-1 rounded">Active</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-900 font-display">156</div>
                    <div class="text-xs text-slate-500 mt-1">23 drivers assigned</div>
                </div>
                <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Low Stock Alert</div>
                        <span class="text-amber-600 text-xs font-semibold bg-amber-50 px-2 py-1 rounded">Warning</span>
                    </div>
                    <div class="text-3xl font-bold text-amber-600 font-display">{{$lowstock}}</div>
                    <div class="text-xs text-slate-500 mt-1">Below MOQ threshold</div>
                </div>
            </div>

            <!-- Critical Alerts -->
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-8">
                <!-- Expiry Alerts -->
                {{-- <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2 font-display">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                            Critical Expiry Alerts
                        </h3>
                        <a href="inventory.html" class="text-xs text-blue-900 hover:underline font-medium">View All →</a>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-red-50 border border-red-100 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-2xl">🥛</div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Fresh Whole Milk 2L</p>
                                    <p class="text-xs text-red-600 font-medium">Lot: M240401-A | Exp: Today</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-600">Qty: 240 units</p>
                                <span class="inline-block mt-1 px-2 py-1 bg-red-500 text-white text-xs font-bold rounded">URGENT</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-amber-50 border border-amber-100 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-2xl">🥚</div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Free-Range Eggs (12pk)</p>
                                    <p class="text-xs text-amber-600 font-medium">Lot: E240331-B | Exp: Tomorrow</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-600">Qty: 180 cartons</p>
                                <span class="inline-block mt-1 px-2 py-1 bg-amber-500 text-white text-xs font-bold rounded">WARNING</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-amber-50 border border-amber-100 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-2xl">🧀</div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Cheddar Cheese Block</p>
                                    <p class="text-xs text-amber-600 font-medium">Lot: C240325-A | Exp: 2 days</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-600">Qty: 85 blocks</p>
                                <span class="inline-block mt-1 px-2 py-1 bg-amber-500 text-white text-xs font-bold rounded">WARNING</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="space-y-3">

                    @foreach($criticalExpiry as $product)

                        @php
                            $expiry = \Carbon\Carbon::parse($product->created_at)
                                        ->addDays($product->shelf_life);

                            $daysLeft = now()->diffInDays($expiry, false);
                        @endphp

                        <div class="flex items-center justify-between 
                            p-4 rounded-xl border
                            {{ $daysLeft <= 0 ? 'bg-red-50 border-red-100' : 'bg-amber-50 border-amber-100' }}">

                            <div class="flex items-center gap-3">

                                <!-- ICON -->
                                <div class="w-12 h-12 rounded-xl 
                                    {{ $daysLeft <= 0 ? 'bg-red-100' : 'bg-amber-100' }}
                                    flex items-center justify-center text-2xl">

                                    <img src="{{ asset($product->image) }}" class="w-8 h-8 object-contain">
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-slate-900">
                                        {{ $product->title }}
                                    </p>

                                    <p class="text-xs font-medium
                                        {{ $daysLeft <= 0 ? 'text-red-600' : 'text-amber-600' }}">

                                        SKU: {{ $product->sku_code }} | 
                                        
                                        Exp: 
                                        @if($daysLeft <= 0)
                                            Today
                                        @elseif($daysLeft == 1)
                                            Tomorrow
                                        @else
                                            {{ $daysLeft }} days
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-xs text-slate-600">
                                    Qty: {{ $product->quantity }} units
                                </p>

                                <span class="inline-block mt-1 px-2 py-1 text-white text-xs font-bold rounded
                                    {{ $daysLeft <= 0 ? 'bg-red-500' : 'bg-amber-500' }}">
                                    
                                    {{ $daysLeft <= 0 ? 'URGENT' : 'WARNING' }}

                                </span>
                            </div>
                        </div>

                    @endforeach
                    

                </div>

                <!-- Delivery Status -->
                {{-- <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2 font-display">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live Delivery Tracking
                        </h3>
                        <a href="deliveries.html" class="text-xs text-blue-900 hover:underline font-medium">Manage →</a>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-sm">JD</div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">John Davies (VAN-04)</p>
                                    <p class="text-xs text-slate-500">8 stops completed • 4 pending</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">ON ROUTE</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm">SM</div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Sarah Miller (VAN-12)</p>
                                    <p class="text-xs text-slate-500">Loading at depot • 12 stops</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">LOADING</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 font-bold text-sm">RK</div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Robert King (VAN-07)</p>
                                    <p class="text-xs text-slate-500">Break time • 6 stops pending</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full">BREAK</span>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="/inventory-page" class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-blue-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition">📦</div>
                    <p class="text-sm font-bold text-slate-900">Manage Inventory</p>
                    <p class="text-xs text-slate-500 mt-1">Stock & locations</p>
                </a>
                <a href="/deliveries" class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition">🚚</div>
                    <p class="text-sm font-bold text-slate-900">Daily Deliveries</p>
                    <p class="text-xs text-slate-500 mt-1">Routes & tracking</p>
                </a>
                <a href="/returns" class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-red-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition">↩️</div>
                    <p class="text-sm font-bold text-slate-900">Process Returns</p>
                    <p class="text-xs text-slate-500 mt-1">3 pending approvals</p>
                </a>
                <a href="/customers" class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-purple-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition">🏪</div>
                    <p class="text-sm font-bold text-slate-900">B2B Customers</p>
                    <p class="text-xs text-slate-500 mt-1">247 active accounts</p>
                </a>
            </div>
        </div>
@endsection        