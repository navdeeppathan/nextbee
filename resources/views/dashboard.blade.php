<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NextBee Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; }
    #sidebar { width: 80px; transition: 0.4s; background: #020617; position: fixed; height: 100vh; z-index: 1000; }
    #sidebar:hover { width: 260px; }
    #main-content { margin-left: 80px; transition: 0.4s; }
    #sidebar:hover ~ #main-content { margin-left: 260px; }
    .nav-item { display: flex; align-items: center; padding: 18px 28px; color: #94a3b8; white-space: nowrap; cursor: pointer; transition: 0.3s; }
    .nav-item:hover { background: rgba(255,255,255,0.05); color: #fff; }
    .nav-label { opacity: 0; transition: opacity 0.3s; margin-left: 25px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; }
    #sidebar:hover .nav-label { opacity: 1; }
    .glass-card { background: white; border-radius: 2rem; padding: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
    .status-pill { display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 999px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; }
    .status-live { background: #dcfce7; color: #16a34a; }
    .status-risk { background: #fee2e2; color: #dc2626; }
</style>
</head>
<body>

{{-- SIDEBAR --}}
<div id="sidebar">
    <div class="flex items-center justify-center py-6 border-b border-white/5">
        <span class="text-white font-black italic text-lg">N<span class="text-blue-500">B</span></span>
    </div>
    <nav class="mt-4">
        <div class="nav-item"><span>📊</span><span class="nav-label">Sales</span></div>
        <div class="nav-item"><span>👤</span><span class="nav-label">Customers</span></div>
        <div class="nav-item"><span>📦</span><span class="nav-label">Warehouse</span></div>
        <div class="nav-item"><span>🚚</span><span class="nav-label">Logistics</span></div>
        <div class="nav-item"><span>⚙️</span><span class="nav-label">Settings</span></div>
        
    </nav>
</div>

<div id="main-content">

    {{-- TOP NAV --}}
    <nav id="topNav" class="fixed top-0 right-0 z-[100] border-b border-white/10 bg-white/80 backdrop-blur-2xl" style="left: 80px; transition: left 0.4s;">
        <div class="max-w-[1500px] mx-auto px-6 py-4 pr-10 flex justify-between items-center">
            <div class="hidden lg:flex items-center space-x-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600">
                <span class="status-pill status-live">Live ERP Sync: Xero Enabled</span>
                <a href="#" class="hover:text-blue-400 transition-colors">Global Reports</a>
                <a href="#" class="hover:text-blue-400 transition-colors">System Health</a>

                <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                    <button
                    type="submit"
                    class="logout-btn"
                    {{-- onclick="logout()"  --}}
                    aria-label="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-[10px] font-black text-slate-900 uppercase italic">Executive Command</p>
                    <p class="text-[9px] text-slate-500 uppercase font-bold">Session ID: 882-XT</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center text-xs font-bold text-blue-500">JD</div>
            </div>
        </div>
    </nav>

    <main class="pt-28 pb-20 px-6 max-w-[1600px] mx-auto">

        <div class="mb-12 flex flex-col md:flex-row justify-between items-end">
            <div>
                <h2 class="text-4xl font-extrabold text-black italic uppercase tracking-tighter">Enterprise Command Center</h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-2">360° Real-time Wholesale Intelligence</p>
            </div>
        </div>

        {{-- MAIN TABS --}}
        <div class="mb-14 flex justify-center">
            <div class="flex bg-white/70 backdrop-blur-xl p-2 rounded-2xl border border-slate-200 shadow-lg gap-2">
                <button onclick="switchMainTab('sales')" id="tab-sales" class="px-8 py-3 text-sm font-extrabold uppercase tracking-widest bg-blue-600 text-black rounded-xl shadow-md transition-all duration-300 hover:scale-105">📊 Sales</button>
                <button onclick="switchMainTab('customer')" id="tab-customer" class="px-8 py-3 text-sm font-extrabold uppercase tracking-widest text-slate-500 rounded-xl transition-all duration-300 hover:bg-red-50 hover:text-red-500 hover:scale-105">👤 Customer</button>
                <button onclick="switchMainTab('warehouse')" id="tab-warehouse" class="px-8 py-3 text-sm font-extrabold uppercase tracking-widest text-slate-500 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-500 hover:scale-105">📦 Warehouse</button>
                <button onclick="switchMainTab('logistics')" id="tab-logistics" class="px-8 py-3 text-sm font-extrabold uppercase tracking-widest text-slate-500 rounded-xl transition-all duration-300 hover:bg-indigo-50 hover:text-indigo-500 hover:scale-105">🚚 Logistics</button>
            </div>
        </div>

        {{-- ==================== SALES PANE ==================== --}}
        <div id="pane-sales" class="dashboard-pane">
            <section class="glass-card p-10 rounded-[3rem] border-blue-500/20 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
                    <div>
                        <h3 class="text-xl font-black uppercase tracking-[0.2em] italic text-blue-500 mb-2">01. Sales Intelligence & Revenue Matrix</h3>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">Toggle between Operational states and AI-Forecasting</p>
                    </div>
                    <div class="flex bg-slate-100 p-1 rounded-xl border border-white/10">
                        <button onclick="switchTab('realtime')" id="tab-realtime" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest bg-blue-600 text-slate-900 rounded-lg transition-all">Real-Time</button>
                        <button onclick="switchTab('historic')" id="tab-historic" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Historic</button>
                        <button onclick="switchTab('predictive')" id="tab-predictive" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Predictive</button>
                    </div>
                </div>

                {{-- REAL-TIME PANE --}}
                <div id="pane-realtime">
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-blue-900/5">
                        <div class="grid md:grid-cols-4 gap-6 mb-12">
                            <div class="p-6 bg-gradient-to-br from-blue-600/10 to-transparent rounded-3xl border border-blue-500/20">
                                <p class="text-[9px] font-black text-blue-400 uppercase mb-3 tracking-widest">Gross Revenue (MTD)</p>
                                <p class="text-4xl font-black italic text-slate-900">£{{ number_format($revenue) }}</p>
                                <div class="flex items-center gap-2 mt-3">
                                    <span class="text-green-400 text-[10px] font-black italic">↑ {{ $revenueGrowthPercent }}% GROWTH</span>
                                </div>
                            </div>
                            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                                <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Avg. Order Value (AOV)</p>
                                <p class="text-4xl font-black italic text-slate-900">£{{ number_format($aov, 2) }}</p>
                                <p class="text-[9px] text-blue-400 font-bold mt-3 uppercase italic">"Larger Order Baskets Enabled"</p>
                            </div>
                            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                                <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Sales Velocity Index</p>
                                <p class="text-4xl font-black italic text-slate-900">
                                    {{ number_format($totalRevenue / max(1, now()->day), 2) }}
                                    <span class="text-sm text-slate-500">/day</span>
                                </p>
                                <p class="text-[9px] text-slate-500 font-bold mt-3 uppercase italic">Optimized Cycle</p>
                            </div>
                            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                                <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Retention Rate</p>
                                <p class="text-4xl font-black italic text-slate-900">{{ number_format($retention, 1) }}%</p>
                                <p class="text-[9px] text-emerald-400 font-bold mt-3 uppercase italic">Intelligent Reordering</p>
                            </div>
                        </div>

                        <div class="grid lg:grid-cols-2 gap-8">
                            {{-- Revenue Chart --}}
                            <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                                <div class="flex justify-between items-center mb-8">
                                    <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300">Revenue Velocity Trend</h4>
                                    <span class="text-[10px] font-mono text-blue-500 uppercase italic">Live ERP Handshake</span>
                                </div>
                                <div class="h-64 relative">
                                    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                                        <span class="text-[80px] font-black italic">NEXTBEE</span>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 h-full flex items-end gap-2 border-l border-b pb-2 pl-2">
                                        @foreach($chartData as $index => $value)
                                            <div class="flex-1 {{ $loop->last ? 'bg-blue-600/80 animate-pulse' : 'bg-blue-600/40' }} rounded-sm" style="height: {{ max(5, $value) }}%"></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase tracking-widest">
                                    @foreach($chartData as $index => $value)
                                        <span>Week {{ $index + 1 }}</span>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Category Profitability --}}
                            <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-8">Category Profitability Matrix</h4>
                                <div class="space-y-6">
                                    @foreach($categoryRevenue as $cat)
                                        <div>
                                            <div class="flex justify-between text-[10px] font-bold mb-2">
                                                <span class="text-slate-900 uppercase italic">{{ $cat['label'] }}</span>
                                                <span class="{{ $cat['color'] }}">£{{ number_format($cat['revenue'] / 1000) }}k</span>
                                            </div>
                                            <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full {{ $cat['bar'] }}" style="width: {{ $cat['percent'] }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-10 pt-6 border-t border-slate-200 flex justify-around text-center">
                                    <div>
                                        <p class="text-xl font-black italic text-slate-900">{{ $newLeads }}</p>
                                        <p class="text-[8px] text-slate-500 uppercase font-bold">New Leads</p>
                                    </div>
                                    <div class="border-x border-white/10 px-8">
                                        <p class="text-xl font-black italic text-slate-900">{{ number_format($upsellRate, 1) }}%</p>
                                        <p class="text-[8px] text-slate-500 uppercase font-bold">Upsell Rate</p>
                                    </div>
                                    <div>
                                        <p class="text-xl font-black italic text-slate-900">£{{ number_format($dailyAvg / 1000, 1) }}k</p>
                                        <p class="text-[8px] text-slate-500 uppercase font-bold">Daily Avg</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- HISTORIC PANE --}}
                <div id="pane-historic" class="hidden">
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-blue-900/5">
                        <div class="grid md:grid-cols-4 gap-6 mb-12">
                            <div class="p-6 bg-gradient-to-br from-blue-600/10 to-transparent rounded-3xl border border-blue-500/20">
                                <p class="text-[9px] font-black text-blue-400 uppercase mb-3 tracking-widest">Gross Revenue (All Time)</p>
                                <p class="text-4xl font-black italic text-slate-900">£{{ number_format($totalRevenue) }}</p>
                                <div class="flex items-center gap-2 mt-3">
                                    <span class="text-green-400 text-[10px] font-black italic">↑ {{ $revenueGrowthPercent }}% GROWTH</span>
                                </div>
                            </div>
                            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                                <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Avg. Order Value (AOV)</p>
                                <p class="text-4xl font-black italic text-slate-900">£{{ number_format($aov, 2) }}</p>
                                <p class="text-[9px] text-blue-400 font-bold mt-3 uppercase italic">"Larger Order Baskets Enabled"</p>
                            </div>
                            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                                <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Total Orders</p>
                                <p class="text-4xl font-black italic text-slate-900">{{ number_format($totalOrders) }}</p>
                                <p class="text-[9px] text-slate-500 font-bold mt-3 uppercase italic">Lifetime Count</p>
                            </div>
                            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                                <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Retention Rate</p>
                                <p class="text-4xl font-black italic text-slate-900">{{ number_format($retention, 1) }}%</p>
                                <p class="text-[9px] text-emerald-400 font-bold mt-3 uppercase italic">Intelligent Reordering</p>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 gap-8">
                            <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                                <div class="flex justify-between items-center mb-8">
                                    <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300">Historic Revenue Trend</h4>
                                    <span class="text-[10px] font-mono text-blue-500 uppercase italic">All Time</span>
                                </div>
                                <div class="h-64 relative">
                                    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                                        <span class="text-[80px] font-black italic">NEXTBEE</span>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 h-full flex items-end gap-2 border-l border-b pb-2 pl-2">
                                        @foreach($monthlyChart as $index => $value)
                                            <div class="flex-1 {{ $loop->last ? 'bg-blue-600/80 animate-pulse' : 'bg-blue-600/40' }} rounded-sm" style="height: {{ max(5, $value) }}%"></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase tracking-widest">
                                    @foreach($monthlyChart as $index => $value)
                                        <span>{{ \Carbon\Carbon::now()->subMonths(count($monthlyChart) - 1 - $index)->format('M') }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-8">Category Profitability Matrix</h4>
                                <div class="space-y-6">
                                    @foreach($categoryRevenue as $cat)
                                        <div>
                                            <div class="flex justify-between text-[10px] font-bold mb-2">
                                                <span class="text-slate-900 uppercase italic">{{ $cat['label'] }}</span>
                                                <span class="{{ $cat['color'] }}">£{{ number_format($cat['revenue'] / 1000) }}k</span>
                                            </div>
                                            <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full {{ $cat['bar'] }}" style="width: {{ $cat['percent'] }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-10 pt-6 border-t border-slate-200 flex justify-around text-center">
                                    <div>
                                        <p class="text-xl font-black italic text-slate-900">{{ $newLeads }}</p>
                                        <p class="text-[8px] text-slate-500 uppercase font-bold">New Leads</p>
                                    </div>
                                    <div class="border-x border-white/10 px-8">
                                        <p class="text-xl font-black italic text-slate-900">{{ number_format($upsellRate, 1) }}%</p>
                                        <p class="text-[8px] text-slate-500 uppercase font-bold">Upsell Rate</p>
                                    </div>
                                    <div>
                                        <p class="text-xl font-black italic text-slate-900">£{{ number_format($dailyAvg / 1000, 1) }}k</p>
                                        <p class="text-[8px] text-slate-500 uppercase font-bold">Daily Avg</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PREDICTIVE PANE --}}
                <div id="pane-predictive" class="hidden">
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-blue-900/5">
                        <div class="grid md:grid-cols-4 gap-6 mb-12">
                            <div class="p-6 bg-gradient-to-br from-blue-600/10 to-transparent rounded-3xl border border-blue-500/20">
                                <p class="text-[9px] font-black text-blue-400 uppercase mb-3 tracking-widest">Forecasted Revenue (Next 30d)</p>
                                <p class="text-4xl font-black italic text-slate-900">£{{ number_format($forecastedRevenue) }}</p>
                                <div class="flex items-center gap-2 mt-3">
                                    <span class="text-green-400 text-[10px] font-black italic">AI Prediction Active</span>
                                </div>
                            </div>
                            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                                <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Predicted AOV</p>
                                <p class="text-4xl font-black italic text-slate-900">£{{ number_format($aov * 1.05, 2) }}</p>
                                <p class="text-[9px] text-blue-400 font-bold mt-3 uppercase italic">+5% Basket Growth</p>
                            </div>
                            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                                <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Predicted Orders</p>
                                <p class="text-4xl font-black italic text-slate-900">{{ number_format($predictedOrders) }}</p>
                                <p class="text-[9px] text-slate-500 font-bold mt-3 uppercase italic">ML Forecast</p>
                            </div>
                            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                                <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Confidence Score</p>
                                <p class="text-4xl font-black italic text-slate-900">{{ $predictionConfidence }}%</p>
                                <p class="text-[9px] text-emerald-400 font-bold mt-3 uppercase italic">Neural Engine Active</p>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 gap-8">
                            <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                                <div class="flex justify-between items-center mb-8">
                                    <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300">Forecast Velocity Curve</h4>
                                    <span class="text-[10px] font-mono text-blue-500 uppercase italic">Predictive Engine</span>
                                </div>
                                <div class="h-64 relative">
                                    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                                        <span class="text-[80px] font-black italic">NEXTBEE</span>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 h-full flex items-end gap-2 border-l border-b pb-2 pl-2">
                                        @foreach($forecastChart as $index => $value)
                                            <div class="flex-1 {{ $index >= count($forecastChart) - 3 ? 'bg-purple-500/60 animate-pulse' : 'bg-blue-600/40' }} rounded-sm" style="height: {{ max(5, $value) }}%"></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase tracking-widest">
                                    @foreach($forecastChart as $index => $value)
                                        <span>{{ $index >= count($forecastChart) - 3 ? 'Pred ' . ($index - count($forecastChart) + 4) : 'W' . ($index + 1) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-8">Top Growth Opportunities</h4>
                                <div class="space-y-6">
                                    @foreach($growthOpportunities as $opp)
                                        <div>
                                            <div class="flex justify-between text-[10px] font-bold mb-2">
                                                <span class="text-slate-900 uppercase italic">{{ $opp['label'] }}</span>
                                                <span class="text-purple-400">+{{ $opp['growth'] }}%</span>
                                            </div>
                                            <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-purple-500" style="width: {{ min(100, $opp['growth']) }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- ==================== CUSTOMER PANE ==================== --}}
        <div id="pane-customer" class="dashboard-pane hidden">
            <section class="glass-card p-10 rounded-[3rem] border-red-500/20 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
                    <div>
                        <h3 class="text-xl font-black uppercase tracking-[0.2em] italic text-red-500 mb-2">02. Behavioral Analytics & Financial Risk</h3>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">Identify churn risks and monitor credit exposure in real-time</p>
                    </div>
                    <div class="flex bg-slate-100 p-1 rounded-xl border border-white/10">
                        <button onclick="switchRiskTab('realtime-risk')" id="tab-realtime-risk" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest bg-red-600 text-slate-900 rounded-lg transition-all">Live Exposure</button>
                        <button onclick="switchRiskTab('behavioral-trends')" id="tab-behavioral-trends" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Behavioral Trends</button>
                        <button onclick="switchRiskTab('predictive-churn')" id="tab-predictive-churn" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Predictive Churn</button>
                    </div>
                </div>

                {{-- LIVE EXPOSURE --}}
                <div id="pane-realtime-risk" class="grid lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-8 glass-card p-8 rounded-[2rem] border-slate-200 bg-red-900/5">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-red-400 italic">Global Credit Exposure Map</h4>
                            <span class="status-pill status-risk">Real-Time Ledger Sync</span>
                        </div>
                        <div class="h-64 relative">
                            <div class="absolute bottom-0 left-0 right-0 h-full flex items-end gap-4 border-l border-b pb-2 pl-2">
                                @foreach($creditChart as $value)
                                    <div class="flex-1 bg-red-600/60 rounded-t-lg" style="height: {{ max(5, $value) }}%"></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase italic">
                            @foreach($creditAging as $key => $val)
                                <span>{{ $key }} Days</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="lg:col-span-4 space-y-4">
                        <div class="p-6 bg-red-500/10 rounded-3xl border border-red-500/20">
                            <p class="text-[9px] font-black text-red-400 uppercase mb-2">Total Outstanding Dues</p>
                            <p class="text-3xl font-black italic text-slate-900">£{{ number_format($totalOutstanding) }}</p>
                            <p class="text-[8px] text-slate-500 mt-2">"Monitor cash flow and credit limits in real-time."</p>
                        </div>
                        <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                            <p class="text-[9px] font-black text-slate-500 uppercase mb-3">Top At-Risk Accounts</p>
                            <div class="space-y-3">
                                @forelse($topCustomers as $customer)
                                    <div class="flex justify-between text-[10px] font-bold italic">
                                        <span class="text-slate-900">{{ $customer->name ?? 'Customer #' . $customer->user_id }}</span>
                                        <span class="text-red-500">£{{ number_format($customer->total_due) }}</span>
                                    </div>
                                @empty
                                    <p class="text-[10px] text-slate-400 italic">No at-risk accounts currently.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BEHAVIORAL TRENDS --}}
                <div id="pane-behavioral-trends" class="hidden grid lg:grid-cols-2 gap-8">
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Ordering Consistency Analytics</h4>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-blue-400 uppercase italic">Stable Ordering ({{ number_format($stableOrderPercent, 1) }}%)</span>
                                    <span class="text-slate-500">£{{ number_format($stableOrderVolume / 1000) }}k Volume</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-600" style="width: {{ $stableOrderPercent }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-red-400 uppercase italic">Declining Frequency ({{ number_format($decliningPercent, 1) }}%)</span>
                                    <span class="text-slate-500">£{{ number_format($decliningVolume / 1000) }}k at risk</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-red-600" style="width: {{ $decliningPercent }}%"></div>
                                </div>
                            </div>
                        </div>
                        <p class="mt-8 text-[9px] text-slate-500 italic font-medium">"Gauge exact customer interests and launch targeted campaigns."</p>
                    </div>
                    <div class="p-8 bg-slate-100 rounded-[2rem]">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Top Basket Growth Partners</h4>
                        <div class="space-y-4">
                            @forelse($topBasketGrowth as $partner)
                                <div class="flex items-center justify-between p-4 bg-blue-600/5 border border-blue-500/10 rounded-2xl">
                                    <span class="text-xs font-bold italic">{{ $partner->name ?? 'Customer #' . $partner->user_id }}</span>
                                    <span class="text-green-400 font-bold text-xs">↑ {{ number_format($partner->growth, 1) }}% Basket Size</span>
                                </div>
                            @empty
                                <p class="text-[10px] text-slate-400 italic">No basket growth data available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- PREDICTIVE CHURN --}}
                <div id="pane-predictive-churn" class="hidden">
                    <div class="glass-card p-10 rounded-[2.5rem] border-purple-500/20 bg-purple-900/5 text-center">
                        <div class="max-w-2xl mx-auto">
                            <div class="text-4xl mb-6">🔮</div>
                            <h4 class="text-2xl font-black text-slate-900 italic uppercase tracking-tighter mb-4">Neural Churn Prediction Active</h4>
                            <p class="text-slate-600 text-sm mb-10 leading-relaxed">
                                NextBee's AI has identified <span class="text-red-400 font-bold italic">{{ $churnRiskCount }} shops</span> that are showing high-probability churn behavior.
                                Targeted follow-ups have been automatically generated in the CRM.
                            </p>
                            <div class="grid md:grid-cols-3 gap-6">
                                <div class="p-6 bg-slate-100 rounded-3xl border border-purple-500/20">
                                    <p class="text-[9px] font-black text-purple-400 uppercase mb-2">Revenue at Risk</p>
                                    <p class="text-2xl font-black italic text-slate-900">£{{ number_format($churnRevenueAtRisk) }}</p>
                                </div>
                                <div class="p-6 bg-slate-100 rounded-3xl border border-purple-500/20">
                                    <p class="text-[9px] font-black text-purple-400 uppercase mb-2">AI Recovery Plan</p>
                                    <p class="text-2xl font-black italic text-slate-900">{{ $churnRiskCount > 0 ? 'Active' : 'Standby' }}</p>
                                </div>
                                <div class="p-6 bg-slate-100 rounded-3xl border border-purple-500/20">
                                    <p class="text-[9px] font-black text-purple-400 uppercase mb-2">Automated Alerts</p>
                                    <p class="text-2xl font-black italic {{ $churnRiskCount > 0 ? 'text-green-400' : 'text-slate-400' }}">{{ $churnRiskCount > 0 ? 'Sent' : 'None' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- ==================== WAREHOUSE PANE ==================== --}}
        <div id="pane-warehouse" class="dashboard-pane hidden">
            <section class="glass-card p-10 rounded-[3rem] border-emerald-500/20 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
                    <div>
                        <h3 class="text-xl font-black uppercase tracking-[0.2em] italic text-emerald-500 mb-2">03. Warehouse Architecture & Neural Inventory</h3>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">Live stock monitoring, aged inventory analytics, and auto-procurement triggers</p>
                    </div>
                    <div class="flex bg-slate-100 p-1 rounded-xl border border-white/10">
                        <button onclick="switchWarehouseTab('stock-live')" id="tab-stock-live" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest bg-emerald-600 text-slate-900 rounded-lg transition-all">Stock Velocity</button>
                        <button onclick="switchWarehouseTab('aged-detail')" id="tab-aged-detail" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Aged Detail</button>
                        <button onclick="switchWarehouseTab('auto-procure')" id="tab-auto-procure" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Auto-Ordering</button>
                    </div>
                </div>

                {{-- STOCK LIVE --}}
                <div id="pane-stock-live" class="grid lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-8 glass-card p-8 rounded-[2rem] border-slate-200 bg-emerald-900/5">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-emerald-400 italic">Inventory Throughput Matrix</h4>
                            <span class="status-pill status-live">Live ERP Sync Active</span>
                        </div>
                        <div class="h-64 flex items-end gap-3 border-l border-b border-white/10 pb-2 pl-2">
                            @foreach($inventoryChart as $index => $value)
                                <div class="flex-1 bg-emerald-600/60 rounded-t-lg {{ $loop->last ? 'animate-pulse' : '' }}" style="height: {{ max(5, $value) }}%"></div>
                            @endforeach
                        </div>
                        <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase italic">
                            @foreach($inventoryCategoryLabels as $label)
                                <span>{{ $label }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="lg:col-span-4 space-y-4">
                        <div class="p-6 bg-emerald-500/10 rounded-3xl border border-emerald-500/20">
                            <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Total Inventory Value</p>
                            <p class="text-3xl font-black italic text-slate-900">£{{ number_format($totalInventoryValue) }}</p>
                            <p class="text-[8px] text-slate-500 mt-2">"Real-time financial oversight and inventory monitoring."</p>
                        </div>
                        <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                            <p class="text-[9px] font-black text-slate-500 uppercase mb-3">Critical Low Stock Alerts</p>
                            <div class="space-y-3">
                                @forelse($lowStock as $item)
                                    <div class="flex justify-between text-[10px] font-bold italic">
                                        <span class="text-slate-900">{{ $item->name }}</span>
                                        <span class="text-red-500">{{ $item->quantity }} Units Left</span>
                                    </div>
                                @empty
                                    <p class="text-[10px] text-slate-400 italic">No critical stock alerts.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AGED DETAIL --}}
                <div id="pane-aged-detail" class="hidden grid lg:grid-cols-2 gap-8">
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Item Aging Risk Distribution</h4>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-emerald-400 uppercase italic">Optimal Rotation (0-45 Days)</span>
                                    <span class="text-slate-500">{{ number_format($freshPercent, 1) }}% of Stock</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-600" style="width: {{ $freshPercent }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-red-400 uppercase italic">Aging Risk (90+ Days)</span>
                                    <span class="text-slate-500">{{ number_format($agedPercent, 1) }}% at risk</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-red-600" style="width: {{ $agedPercent }}%"></div>
                                </div>
                            </div>
                        </div>
                        <p class="mt-8 text-[9px] text-slate-500 italic font-medium">"Set automatic promotional triggers to keep your inventory fresh."</p>
                    </div>
                    <div class="p-8 bg-slate-100 rounded-[2rem]">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Recommended Liquidations</h4>
                        <div class="space-y-4">
                            @forelse($agedItems as $item)
                                <div class="flex items-center justify-between p-4 bg-red-600/5 border border-red-500/10 rounded-2xl">
                                    <span class="text-xs font-bold italic">{{ $item->name }} ({{ $item->sku_code ?? 'N/A' }})</span>
                                    <span class="text-red-400 font-bold text-xs">Aged: {{ \Carbon\Carbon::parse($item->created_at)->diffInDays(now()) }} Days</span>
                                </div>
                            @empty
                                <div class="flex items-center justify-between p-4 bg-emerald-600/5 border border-emerald-500/10 rounded-2xl">
                                    <span class="text-xs font-bold italic text-emerald-400">No items require liquidation.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- AUTO-PROCURE --}}
                <div id="pane-auto-procure" class="hidden">
                    <div class="glass-card p-10 rounded-[2.5rem] border-blue-500/20 bg-blue-900/5 text-center">
                        <div class="max-w-2xl mx-auto">
                            <div class="text-4xl mb-6">⚙️</div>
                            <h4 class="text-2xl font-black text-slate-900 italic uppercase tracking-tighter mb-4">Neural Auto-Procurement Logic</h4>
                            <p class="text-slate-600 text-sm mb-10 leading-relaxed">
                                NextBee's AI has automated procurement for <span class="text-emerald-400 font-bold italic">{{ $autoProcureCount }} high-velocity items</span>.
                                Reorder points are dynamically adjusted based on sales performance velocity.
                            </p>
                            <div class="grid md:grid-cols-3 gap-6">
                                <div class="p-6 bg-slate-100 rounded-3xl border border-emerald-500/20">
                                    <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Automated POs Sent</p>
                                    <p class="text-2xl font-black italic text-slate-900">{{ $autoPOsToday }} Today</p>
                                </div>
                                <div class="p-6 bg-slate-100 rounded-3xl border border-emerald-500/20">
                                    <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Safety Stock Level</p>
                                    <p class="text-2xl font-black italic text-slate-900">{{ $safetyStockPercent }}%</p>
                                </div>
                                <div class="p-6 bg-slate-100 rounded-3xl border border-emerald-500/20">
                                    <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Procurement Savings</p>
                                    <p class="text-2xl font-black italic text-green-400">£{{ number_format($procurementSavings) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- ==================== LOGISTICS PANE ==================== --}}
        <div id="pane-logistics" class="dashboard-pane hidden">
            <section class="glass-card p-10 rounded-[3rem] border-indigo-500/20 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
                    <div>
                        <h3 class="text-xl font-black uppercase tracking-[0.2em] italic text-indigo-500 mb-2">04. Logistics Command & Fulfillment Velocity</h3>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">Route optimization, delivery integrity, and real-time fleet reporting</p>
                    </div>
                    <div class="flex bg-slate-100 p-1 rounded-xl border border-white/10">
                        <button onclick="switchLogisticsTab('fleet-live')" id="tab-fleet-live" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest bg-indigo-600 text-slate-900 rounded-lg transition-all">Fleet Ops</button>
                        <button onclick="switchLogisticsTab('delivery-metrics')" id="tab-delivery-metrics" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Fulfillment</button>
                        <button onclick="switchLogisticsTab('shortage-reports')" id="tab-shortage-reports" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Shortage Alerts</button>
                    </div>
                </div>

                {{-- FLEET LIVE --}}
                <div id="pane-fleet-live" class="grid lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-8 glass-card p-8 rounded-[2rem] border-slate-200 bg-indigo-900/5">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-indigo-400 italic">Global Fleet Optimization Matrix</h4>
                            <span class="status-pill status-live">GPS Signal Active</span>
                        </div>
                        <div class="h-64 flex items-end gap-3 border-l border-b border-white/10 pb-2 pl-2">
                            @foreach($fleetData as $van)
                                <div class="flex-1 bg-indigo-600/{{ $loop->index % 2 === 0 ? '40' : '60' }} rounded-t-lg {{ $van['active'] ? 'animate-pulse shadow-[0_0_15px_rgba(79,70,229,0.3)]' : '' }}" style="height: {{ max(5, $van['utilization']) }}%"></div>
                            @endforeach
                        </div>
                        <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase italic">
                            @foreach($fleetData as $van)
                                <span>{{ $van['name'] }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="lg:col-span-4 space-y-4">
                        <div class="p-6 bg-indigo-500/10 rounded-3xl border border-indigo-500/20">
                            <p class="text-[9px] font-black text-indigo-400 uppercase mb-2">Daily Route Efficiency</p>
                            <p class="text-3xl font-black italic text-slate-900">{{ number_format($routeEfficiency, 1) }}%</p>
                            <p class="text-[8px] text-slate-500 mt-2">"App-based route optimization maximizing delivery velocity."</p>
                        </div>
                        <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                            <p class="text-[9px] font-black text-slate-500 uppercase mb-3">Live Fleet Performance</p>
                            <div class="space-y-3">
                                <div class="flex justify-between text-[10px] font-bold italic">
                                    <span class="text-slate-900">Active Deliveries</span>
                                    <span class="text-blue-500">{{ $activeDeliveries }}</span>
                                </div>
                                <div class="flex justify-between text-[10px] font-bold italic">
                                    <span class="text-slate-900">Avg. Drop Time</span>
                                    <span class="text-blue-500">{{ round($avgDropTime, 1) }}m</span>
                                </div>
                                <div class="flex justify-between text-[10px] font-bold italic">
                                    <span class="text-slate-900">Delivered Today</span>
                                    <span class="text-emerald-500">{{ $totalDelivered }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DELIVERY METRICS --}}
                <div id="pane-delivery-metrics" class="hidden grid lg:grid-cols-2 gap-8">
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Delivery Integrity Index</h4>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-indigo-400 uppercase italic">Digital POD Rate ({{ $podRate }}%)</span>
                                    <span class="text-slate-500">Target: Universal</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 shadow-[0_0_10px_#4f46e5]" style="width: {{ $podRate }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-emerald-400 uppercase italic">On-Time Fulfillment ({{ number_format($onTimePercent, 1) }}%)</span>
                                    <span class="text-slate-500">Live Metric</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-500" style="width: {{ $onTimePercent }}%"></div>
                                </div>
                            </div>
                        </div>
                        <p class="mt-8 text-[9px] text-slate-500 italic font-medium uppercase">"Seamless operations through digital proof of delivery."</p>
                    </div>
                    <div class="p-8 bg-slate-100 rounded-[2rem]">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Recent Customer Acknowledgements</h4>
                        <div class="space-y-4">
                            @forelse($recentPODs as $pod)
                                <div class="flex items-center justify-between p-4 bg-emerald-600/5 border border-emerald-500/10 rounded-2xl">
                                    <span class="text-xs font-bold italic">{{ $pod->reference ?? 'Order #' . $pod->id }}: {{ $pod->pod_type ?? 'Signature' }} Received</span>
                                    <span class="text-emerald-400 font-bold text-[8px] uppercase">Synced to ERP</span>
                                </div>
                            @empty
                                <p class="text-[10px] text-slate-400 italic">No recent PODs recorded.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- SHORTAGE REPORTS --}}
                <div id="pane-shortage-reports" class="hidden">
                    <div class="glass-card p-10 rounded-[2.5rem] border-red-500/20 bg-red-900/5 text-center">
                        <div class="max-w-2xl mx-auto">
                            <div class="text-4xl mb-6">🛑</div>
                            <h4 class="text-2xl font-black text-slate-900 italic uppercase tracking-tighter mb-4">Real-Time Shortage Resolution</h4>
                            <p class="text-slate-600 text-sm mb-10 leading-relaxed">
                                NextBee's Logistics Layer has detected <span class="text-red-400 font-bold italic">{{ $shortagesCount }} shortages</span> during live delivery.
                                Financial credit notes have been automatically drafted in Xero/Sage.
                            </p>
                            <div class="grid md:grid-cols-3 gap-6">
                                <div class="p-6 bg-slate-100 rounded-3xl border border-red-500/20">
                                    <p class="text-[9px] font-black text-red-400 uppercase mb-2">Shortages Detected</p>
                                    <p class="text-2xl font-black italic text-slate-900">{{ str_pad($shortagesCount, 2, '0', STR_PAD_LEFT) }} Today</p>
                                </div>
                                <div class="p-6 bg-slate-100 rounded-3xl border border-red-500/20">
                                    <p class="text-[9px] font-black text-red-400 uppercase mb-2">Revenue Leakage Guarded</p>
                                    <p class="text-2xl font-black italic text-slate-900">£{{ number_format($shortageRevenue, 2) }}</p>
                                </div>
                                <div class="p-6 bg-slate-100 rounded-3xl border border-red-500/20">
                                    <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Resolution Status</p>
                                    <p class="text-2xl font-black italic text-green-400">Automated</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- ==================== INVENTORY TABLE ==================== --}}
        <div class="glass-card rounded-[2.5rem] overflow-hidden mt-8">
            <div class="p-8">
                <h1 class="text-3xl md:text-4xl font-black italic uppercase tracking-tight text-slate-900 mb-6">Inventory Control & Expiry Intelligence</h1>
            </div>
            <div class="p-8 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
                <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">02. Live Stock Adjustment & Expiry Protocol</h3>
                <div class="flex gap-2">
                    <a href="{{ route('inventory.purge-expired') }}" onclick="return confirm('PROTOCOL WARNING: Are you sure you want to purge all expired stock from the active ledger?')"
                       class="bg-red-50 text-red-600 px-4 py-2 rounded-lg text-[9px] font-black uppercase border border-red-100 hover:bg-red-100 transition">
                        Purge Expired Items
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-100 border-b border-slate-200">
                        <tr>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Inventory Item</th>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Expiry Date</th>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Current Qty</th>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Status</th>
                            <th class="p-5 text-center text-[9px] font-black uppercase text-slate-400">Protocol</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($inventory as $item)
                            @php
                                $isExpired = \Carbon\Carbon::parse($item->expiry_date)->isPast();
                                $expiresSoon = !$isExpired && \Carbon\Carbon::parse($item->expiry_date)->diffInDays(now()) <= 7;
                            @endphp
                            <tr class="{{ $isExpired ? 'bg-red-50/50' : ($expiresSoon ? 'bg-amber-50/50' : '') }} hover:bg-slate-50 transition-colors">
                                <td class="p-5">
                                    <p class="text-xs font-black italic text-slate-900 uppercase">{{ $item->name }}</p>
                                    <p class="text-[8px] text-slate-400 font-bold tracking-widest uppercase">SKU: {{ $item->sku_code ?? 'N/A' }}</p>
                                </td>
                                <td class="p-5 text-xs font-bold italic {{ $isExpired ? 'text-red-600' : ($expiresSoon ? 'text-amber-600' : 'text-slate-600') }}">
                                    {{ \Carbon\Carbon::parse($item->expiry_date)->format('Y-m-d') }}
                                    @if($isExpired) <span class="text-[8px] font-black">[EXPIRED]</span>
                                    @elseif($expiressoon) <span class="text-[8px] font-black">[EXPIRING SOON]</span>
                                    @endif
                                </td>
                                <td class="p-5 text-xs font-black text-slate-900">{{ $item->quantity }} Units</td>
                                <td class="p-5">
                                    @if($isExpired)
                                        <span class="px-2 py-1 bg-red-50 text-red-600 rounded-full text-[8px] font-black uppercase border border-red-100">Expired</span>
                                    @elseif($expiresoon)
                                        <span class="px-2 py-1 bg-amber-50 text-amber-600 rounded-full text-[8px] font-black uppercase border border-amber-100">Expiring Soon</span>
                                    @elseif($item->quantity < 10)
                                        <span class="px-2 py-1 bg-orange-50 text-orange-600 rounded-full text-[8px] font-black uppercase border border-orange-100">Low Stock</span>
                                    @else
                                        <span class="px-2 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[8px] font-black uppercase border border-emerald-100">Active</span>
                                    @endif
                                </td>
                                <td class="p-5 text-center">
                                    <form method="POST" action="{{ route('inventory.remove', $item->id) }}" onsubmit="return confirm('Remove this item?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-300 hover:text-red-500 transition text-xs font-bold">🗑 Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-slate-400 text-xs italic">No inventory items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ==================== DISPATCH QUEUE ==================== --}}
        <div class="glass-card rounded-[2.5rem] overflow-hidden mt-10">
            <div class="p-8">
                <h1 class="text-3xl md:text-4xl font-black italic uppercase tracking-tight text-slate-900 mb-6">Delivery Operations & Dispatch Control</h1>
            </div>
            <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">01. Merchant Dispatch Queue</h3>
                <div class="flex gap-2">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-[9px] font-black">{{ $pendingDispatchCount }} PENDING DISPATCH</span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Select</th>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Order Ref</th>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Merchant Name</th>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Region</th>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Payload Details</th>
                            <th class="p-5 text-[9px] font-black uppercase text-slate-400">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($dispatchQueue as $order)
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">{{ $order->customer_name ?? $order->user->name ?? 'Unknown' }}</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">{{ $order->delivery_region ?? $order->delivery_address ?? 'N/A' }}</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">
                                    {{ $order->items_count ?? $order->orderItems->count() }} Items /
                                    {{ $order->total_weight ?? 'N/A' }}KG
                                </td>
                                <td class="p-5">
                                    <a href="{{ route('orders.dispatch', $order->id) }}"
                                       class="px-3 py-1 bg-indigo-600 text-white rounded-lg text-[9px] font-black hover:bg-indigo-700 transition">
                                        Dispatch
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-slate-400 text-xs italic">No orders pending dispatch.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ==================== ORDER FULFILLMENT TABLE ==================== --}}
        <div class="mt-10">
            <h1 class="text-3xl md:text-4xl font-black italic uppercase tracking-tight text-slate-900 mb-6">Order Fulfillment & Delivery Overview</h1>
            <div class="glass-card rounded-[2.5rem] overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Order Ref</th>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Customer Profile</th>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Fulfillment Status</th>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Order Date</th>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Total Dues</th>
                            <th class="p-5 text-center text-[10px] font-black uppercase text-slate-500 tracking-widest">Drill-Down</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($orders as $order)
                            @php
                                $statusColors = [
                                    'processing' => ['bg' => 'blue', 'label' => 'Processing'],
                                    'dispatched' => ['bg' => 'indigo', 'label' => 'Dispatched'],
                                    'delivered'  => ['bg' => 'green', 'label' => 'Delivered'],
                                    'pending'    => ['bg' => 'yellow', 'label' => 'Pending'],
                                    'cancelled'  => ['bg' => 'red', 'label' => 'Cancelled'],
                                ];
                                $sc = $statusColors[$order->status] ?? ['bg' => 'slate', 'label' => ucfirst($order->status)];
                            @endphp
                            <tr class="hover:bg-slate-50 transition-all cursor-pointer group">
                                <td class="p-5 text-xs font-black text-blue-600 tracking-tighter">#NB-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="p-5">
                                    <p class="text-xs font-black uppercase italic text-slate-900">{{ $order->user->name ?? 'Guest' }}</p>
                                    <p class="text-[8px] text-slate-400 font-bold tracking-widest">ERP VERIFIED</p>
                                </td>
                                <td class="p-5">
                                    <span class="px-3 py-1 rounded-full bg-{{ $sc['bg'] }}-50 text-{{ $sc['bg'] }}-600 text-[8px] font-black uppercase border border-{{ $sc['bg'] }}-100">
                                        {{ $sc['label'] }}
                                    </span>
                                </td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 italic uppercase">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                                <td class="p-5 text-xs font-black text-slate-900 italic">£{{ number_format($order->total_price, 2) }}</td>
                                <td class="p-5 text-center">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                       class="w-8 h-8 mx-auto rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">👁</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-slate-400 text-xs italic">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator && $orders->hasPages())
                    <div class="px-10 py-6 flex justify-between items-center bg-slate-50 border-t border-slate-200">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Showing <span class="text-blue-600 italic">{{ $orders->firstItem() }}-{{ $orders->lastItem() }}</span> of {{ $orders->total() }} Orders
                        </p>
                        <div class="flex gap-2 items-center">
                            @if($orders->onFirstPage())
                                <span class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300">←</span>
                            @else
                                <a href="{{ $orders->previousPageUrl() }}" class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-white transition-all">←</a>
                            @endif

                            @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="w-10 h-10 rounded-xl {{ $page == $orders->currentPage() ? 'bg-blue-600 text-white shadow-md' : 'border border-slate-200 text-slate-900 hover:bg-white' }} font-black text-[10px] flex items-center justify-center transition-all">{{ $page }}</a>
                            @endforeach

                            @if($orders->hasMorePages())
                                <a href="{{ $orders->nextPageUrl() }}" class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-900 hover:bg-white">→</a>
                            @else
                                <span class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300">→</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- ==================== FOOTER ==================== --}}
        <footer class="bg-slate-100 pt-24 pb-12 px-6 border-t border-slate-200 mt-20 rounded-[2rem]">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-12 mb-20">
                    <div class="col-span-2">
                        <div class="text-2xl font-black text-slate-900 uppercase italic mb-6">Next<span class="text-blue-500">Bee</span></div>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest leading-loose mb-8">Streamlining Operations,<br>Maximizing Efficiency.</p>
                        <div class="flex gap-4">
                            <div class="w-8 h-8 rounded-lg bg-slate-200 border border-white/10 flex items-center justify-center hover:bg-blue-600 hover:text-white transition cursor-pointer italic font-bold text-xs">in</div>
                            <div class="w-8 h-8 rounded-lg bg-slate-200 border border-white/10 flex items-center justify-center hover:bg-blue-600 hover:text-white transition cursor-pointer italic font-bold text-xs">X</div>
                        </div>
                    </div>
                    <div>
                        <h5 class="text-slate-900 font-black text-[10px] uppercase tracking-[0.3em] mb-8">Solutions</h5>
                        <ul class="text-slate-500 text-[10px] font-bold uppercase space-y-4 tracking-widest">
                            <li><a href="#" class="hover:text-blue-400 transition">Customer Portal</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Driver Systems</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Command Center</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Inventory AI</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="text-slate-900 font-black text-[10px] uppercase tracking-[0.3em] mb-8">Connectivity</h5>
                        <ul class="text-slate-500 text-[10px] font-bold uppercase space-y-4 tracking-widest">
                            <li><a href="#" class="hover:text-blue-400 transition">Xero Sync</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Sage 200</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">MS Dynamics</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">SAP B1</a></li>
                        </ul>
                    </div>
                    <div class="col-span-2">
                        <h5 class="text-slate-900 font-black text-[10px] uppercase tracking-[0.3em] mb-8">Global Headquarters</h5>
                        <div class="space-y-4">
                            <p class="text-slate-700 font-black text-xl italic">{{ config('app.contact_phone', '07879 175585') }}</p>
                            <p class="text-blue-400 font-bold text-sm tracking-widest">{{ config('app.contact_email', 'sales@thenexteck.com') }}</p>
                            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.2em]">{{ config('app.url') }}</p>
                        </div>
                    </div>
                </div>
                <div class="pt-12 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-[9px] font-black text-slate-600 uppercase tracking-[0.5em]">Command. Control. Conquer.</div>
                    <div class="flex gap-8 text-[9px] font-black text-slate-600 uppercase tracking-widest">
                        <a href="#" class="hover:text-slate-900 transition">Privacy Protocol</a>
                        <a href="#" class="hover:text-slate-900 transition">Security Architecture</a>
                        <a href="#" class="hover:text-slate-900 transition">Compliance</a>
                    </div>
                    <div class="text-[9px] font-black text-slate-700 uppercase tracking-widest">© {{ now()->year }} NextBee. A Nexteck Enterprise Platform.</div>
                </div>
            </div>
        </footer>

    </main>
</div>

<script>
    // Main tab switcher
    function switchMainTab(type) {
        const tabs = ['sales', 'customer', 'warehouse', 'logistics'];
        tabs.forEach(t => {
            document.getElementById('pane-' + t)?.classList.add('hidden');
            const btn = document.getElementById('tab-' + t);
            if (btn) { btn.classList.remove('bg-blue-600', 'text-slate-900'); btn.classList.add('text-slate-500'); }
        });
        document.getElementById('pane-' + type)?.classList.remove('hidden');
        const active = document.getElementById('tab-' + type);
        if (active) { active.classList.add('bg-blue-600', 'text-slate-900'); active.classList.remove('text-slate-500'); }
    }

    // Sales sub-tabs
    function switchTab(type) {
        ['realtime', 'historic', 'predictive'].forEach(p => {
            document.getElementById('pane-' + p)?.classList.add('hidden');
            const btn = document.getElementById('tab-' + p);
            if (btn) { btn.classList.remove('bg-blue-600', 'text-slate-900'); btn.classList.add('text-slate-500'); }
        });
        document.getElementById('pane-' + type)?.classList.remove('hidden');
        const active = document.getElementById('tab-' + type);
        if (active) { active.classList.add('bg-blue-600', 'text-slate-900'); active.classList.remove('text-slate-500'); }
    }

    // Customer risk tabs
    function switchRiskTab(type) {
        ['realtime-risk', 'behavioral-trends', 'predictive-churn'].forEach(p => {
            document.getElementById('pane-' + p)?.classList.add('hidden');
            const btn = document.getElementById('tab-' + p);
            if (btn) { btn.classList.remove('bg-red-600', 'text-slate-900'); btn.classList.add('text-slate-500'); }
        });
        document.getElementById('pane-' + type)?.classList.remove('hidden');
        const active = document.getElementById('tab-' + type);
        if (active) { active.classList.add('bg-red-600', 'text-slate-900'); active.classList.remove('text-slate-500'); }
    }

    // Warehouse tabs
    function switchWarehouseTab(type) {
        ['stock-live', 'aged-detail', 'auto-procure'].forEach(p => {
            document.getElementById('pane-' + p)?.classList.add('hidden');
            const btn = document.getElementById('tab-' + p);
            if (btn) { btn.classList.remove('bg-emerald-600', 'text-slate-900'); btn.classList.add('text-slate-500'); }
        });
        document.getElementById('pane-' + type)?.classList.remove('hidden');
        const active = document.getElementById('tab-' + type);
        if (active) { active.classList.add('bg-emerald-600', 'text-slate-900'); active.classList.remove('text-slate-500'); }
    }

    // Logistics tabs
    function switchLogisticsTab(type) {
        ['fleet-live', 'delivery-metrics', 'shortage-reports'].forEach(p => {
            document.getElementById('pane-' + p)?.classList.add('hidden');
            const btn = document.getElementById('tab-' + p);
            if (btn) { btn.classList.remove('bg-indigo-600', 'text-slate-900'); btn.classList.add('text-slate-500'); }
        });
        document.getElementById('pane-' + type)?.classList.remove('hidden');
        const active = document.getElementById('tab-' + type);
        if (active) { active.classList.add('bg-indigo-600', 'text-slate-900'); active.classList.remove('text-slate-500'); }
    }

    // Sidebar nav shift
    const sidebar = document.getElementById('sidebar');
    const topNav = document.getElementById('topNav');
    sidebar?.addEventListener('mouseenter', () => { if (topNav) topNav.style.left = '260px'; });
    sidebar?.addEventListener('mouseleave', () => { if (topNav) topNav.style.left = '80px'; });
</script>
</body>
</html>