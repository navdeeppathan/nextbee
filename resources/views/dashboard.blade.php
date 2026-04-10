
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NextBee Dashboard</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f8fafc;
    }

    /* SIDEBAR */
    #sidebar {
        width: 80px;
        transition: 0.4s;
        background: #020617;
        position: fixed;
        height: 100vh;
        z-index: 1000;
    }

    #sidebar:hover {
        width: 260px;
    }

    /* MAIN CONTENT SHIFT */
    #main-content {
        margin-left: 80px;
        transition: 0.4s;
    }

    #sidebar:hover ~ #main-content {
        margin-left: 260px;
    }

    /* NAV ITEM */
    .nav-item { display: flex; align-items: center; padding: 18px 28px; color: #94a3b8; white-space: nowrap; cursor: pointer; transition: 0.3s; }
            .nav-item:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }
            .nav-label { opacity: 0; transition: opacity 0.3s; margin-left: 25px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; }

    #sidebar:hover .nav-label {
        opacity: 1;
    }

    /* CARD */
    .glass-card {
        background: white;
        border-radius: 2rem;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }
</style>
</head>

<body>





<!-- RIGHT SIDE -->
<div id="main-content">

<nav class="fixed top-0 w-full z-[100] border-b border-white/10 bg-white/80 backdrop-blur-2xl">
        <div class="max-w-[1500px] mx-auto px-6 py-4 pr-20 flex justify-between items-center">
            <!--<div class="flex items-center gap-2 group cursor-pointer">-->
            <!--    <div class="w-10 h-10 bg-blue-600 rounded-xl text-white flex items-center justify-center font-black text-slate-900 shadow-[0_0_20px_rgba(37,99,235,0.4)]">NB</div>-->
            <!--    <div class="text-2xl font-extrabold tracking-tighter text-slate-900 uppercase italic">Next<span class="text-blue-500 text-[1.2em]">Bee</span></div>-->
            <!--</div>-->
          
            <div class="hidden lg:flex items-center space-x-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600">
                <span class="status-pill status-live">Live ERP Sync: Xero Enabled</span>
                <a href="#" class="hover:text-blue-400 transition-colors">Global Reports</a>
                <a href="#" class="hover:text-blue-400 transition-colors">System Health</a>
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
        <div class="hero-mesh"></div>

        <div class="mb-12 flex flex-col md:flex-row justify-between items-end">
            <div>
                <h2 class="text-4xl font-extrabold text-black italic uppercase tracking-tighter">Enterprise Command Center</h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-2">360° Real-time Wholesale Intelligence</p>
            </div>
           
        </div>



<div class="mb-14 flex justify-center">
    <div class="flex bg-white/70 backdrop-blur-xl p-2 rounded-2xl border border-slate-200 shadow-lg gap-2">

        <button onclick="switchMainTab('sales')" id="tab-sales"
            class="main-tab-active px-8 py-3 text-sm font-extrabold uppercase tracking-widest bg-blue-600 text-black rounded-xl shadow-md transition-all duration-300 hover:scale-105">
            📊 Sales
        </button>

        <button onclick="switchMainTab('customer')" id="tab-customer"
            class="px-8 py-3 text-sm font-extrabold uppercase tracking-widest text-slate-500 rounded-xl transition-all duration-300 hover:bg-red-50 hover:text-red-500 hover:scale-105">
            👤 Customer
        </button>

        <button onclick="switchMainTab('warehouse')" id="tab-warehouse"
            class="px-8 py-3 text-sm font-extrabold uppercase tracking-widest text-slate-500 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-500 hover:scale-105">
            📦 Warehouse
        </button>

        <button onclick="switchMainTab('logistics')" id="tab-logistics"
            class="px-8 py-3 text-sm font-extrabold uppercase tracking-widest text-slate-500 rounded-xl transition-all duration-300 hover:bg-indigo-50 hover:text-indigo-500 hover:scale-105">
            🚚 Logistics
        </button>

    </div>
</div>
<script>
function switchMainTab(type) {
    const tabs = ['sales', 'customer', 'warehouse', 'logistics'];

    tabs.forEach(t => {
        document.getElementById('pane-' + t).classList.add('hidden');

        document.getElementById('tab-' + t)
            .classList.remove('bg-blue-600', 'text-slate-900');

        document.getElementById('tab-' + t)
            .classList.add('text-slate-500');
    });

    document.getElementById('pane-' + type).classList.remove('hidden');

    document.getElementById('tab-' + type)
        .classList.add('bg-blue-600', 'text-slate-900');

    document.getElementById('tab-' + type)
        .classList.remove('text-slate-500');
}
</script>


<div id="pane-sales" class="dashboard-pane">
    <section id="sales-intelligence" class="lg:col-span-12 glass-card p-10 rounded-[3rem] border-blue-500/20 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h3 class="text-xl font-black uppercase tracking-[0.2em] italic text-blue-500 mb-2">01. Sales Intelligence & Revenue Matrix</h3>
                <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">Toggle between Operational states and AI-Forecasting</p>
            </div>
            
            <div class="flex bg-slate-100 p-1 rounded-xl border border-white/10">
                <button onclick="switchTab('realtime')" id="tab-realtime" class="tab-btn-active px-6 py-2 text-[10px] font-black uppercase tracking-widest bg-blue-600 rounded-lg transition-all">Real-Time</button>
                <button onclick="switchTab('historic')" id="tab-historic" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Historic</button>
                <button onclick="switchTab('predictive')" id="tab-predictive" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 transition-all">Predictive</button>
            </div>
        </div>
    
        <div id="pane-realtime" class="grid lg:grid-cols-1 gap-8">
            <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-blue-900/5">

            
                <div class="grid md:grid-cols-4 gap-6 mb-12">
                    <div class="p-6 bg-gradient-to-br from-blue-600/10 to-transparent rounded-3xl border border-blue-500/20">
                        <p class="text-[9px] font-black text-blue-400 uppercase mb-3 tracking-widest">Gross Revenue (MTD)</p>
                        <p class="text-4xl metric-value text-slate-900">£248,520</p>
                        <div class="flex items-center gap-2 mt-3">
                            <span class="text-green-400 text-[10px] font-black italic">↑ 184% GROWTH </span>
                        </div>
                    </div>
                    <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                        <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Avg. Order Value (AOV)</p>
                        <p class="text-4xl metric-value text-slate-900">£1,840</p>
                        <p class="text-[9px] text-blue-400 font-bold mt-3 uppercase italic">"Larger Order Baskets Enabled"</p>
                    </div>
                    <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                        <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Sales Velocity Index</p>
                        <p class="text-4xl metric-value text-slate-900">8.4<span class="text-sm text-slate-500">/10</span></p>
                        <p class="text-[9px] text-slate-500 font-bold mt-3 uppercase italic">Optimized Cycle </p>
                    </div>
                    <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                        <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Retention Rate</p>
                        <p class="text-4xl metric-value text-slate-900">92%</p>
                        <p class="text-[9px] text-emerald-400 font-bold mt-3 uppercase italic">Intelligent Reordering</p>
                    </div>
                </div>
            
                <div class="grid lg:grid-cols-2 gap-8">
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                        <div class="flex justify-between items-center mb-8">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300">Revenue Velocity Trend</h4>
                            <span class="text-[10px] font-mono text-blue-500 uppercase italic">Live ERP Handshake</span>
                        </div>
                        <div class="h-64 flex items-end justify-between gap-1 px-2 relative">
                            <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                                <span class="text-[80px] font-black italic">NEXTBEE</span>
                            </div>
                            <div class="w-full h-full flex items-end gap-2 border-l border-b border-white/10 pb-2 pl-2">
                                <div class="flex-1 bg-blue-600/40 h-[30%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/40 h-[45%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/40 h-[40%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/40 h-[60%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/60 h-[75%] rounded-sm shadow-[0_0_15px_rgba(37,99,235,0.3)]"></div>
                                <div class="flex-1 bg-blue-600/40 h-[65%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/80 h-[90%] rounded-sm shadow-[0_0_25px_rgba(37,99,235,0.5)] animate-pulse"></div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase tracking-widest">
                            <span>Week 01</span><span>Week 02</span><span>Week 03</span><span>Current</span>
                        </div>
                    </div>
            
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-8">Category Profitability Matrix</h4>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-slate-900 uppercase italic">High-Volume Wholesale</span>
                                    <span class="text-blue-400">£142k</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-600 w-[75%] shadow-[0_0_10px_#2563eb]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-slate-900 uppercase italic">Retail Partner Orders</span>
                                    <span class="text-indigo-400">£86k</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-500 w-[55%]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-slate-900 uppercase italic">Direct Dispatch</span>
                                    <span class="text-emerald-400">£20k</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-500 w-[20%]"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 pt-6 border-t border-slate-200 flex justify-around text-center">
                            <div>
                                <p class="text-xl font-black italic text-slate-900">48</p>
                                <p class="text-[8px] text-slate-500 uppercase font-bold">New Leads</p>
                            </div>
                            <div class="border-x border-white/10 px-8">
                                <p class="text-xl font-black italic text-slate-900">12%</p>
                                <p class="text-[8px] text-slate-500 uppercase font-bold">Upsell Rate</p>
                            </div>
                            <div>
                                <p class="text-xl font-black italic text-slate-900">£7.4k</p>
                                <p class="text-[8px] text-slate-500 uppercase font-bold">Daily Avg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    
        <div id="pane-historic" class="hidden grid lg:grid-cols-1 gap-8">
            <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-blue-900/5">

            
                <div class="grid md:grid-cols-4 gap-6 mb-12">
                    <div class="p-6 bg-gradient-to-br from-blue-600/10 to-transparent rounded-3xl border border-blue-500/20">
                        <p class="text-[9px] font-black text-blue-400 uppercase mb-3 tracking-widest">Gross Revenue (MTD)</p>
                        <p class="text-4xl metric-value text-slate-900">£248,520</p>
                        <div class="flex items-center gap-2 mt-3">
                            <span class="text-green-400 text-[10px] font-black italic">↑ 184% GROWTH </span>
                        </div>
                    </div>
                    <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                        <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Avg. Order Value (AOV)</p>
                        <p class="text-4xl metric-value text-slate-900">£1,840</p>
                        <p class="text-[9px] text-blue-400 font-bold mt-3 uppercase italic">"Larger Order Baskets Enabled"</p>
                    </div>
                    <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                        <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Sales Velocity Index</p>
                        <p class="text-4xl metric-value text-slate-900">8.4<span class="text-sm text-slate-500">/10</span></p>
                        <p class="text-[9px] text-slate-500 font-bold mt-3 uppercase italic">Optimized Cycle</p>
                    </div>
                    <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                        <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Retention Rate</p>
                        <p class="text-4xl metric-value text-slate-900">92%</p>
                        <p class="text-[9px] text-emerald-400 font-bold mt-3 uppercase italic">Intelligent Reordering</p>
                    </div>
                </div>
            
                <div class="grid lg:grid-cols-2 gap-8">
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                        <div class="flex justify-between items-center mb-8">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300">Revenue Velocity Trend</h4>
                            <span class="text-[10px] font-mono text-blue-500 uppercase italic">Live ERP Handshake</span>
                        </div>
                        <div class="h-64 flex items-end justify-between gap-1 px-2 relative">
                            <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                                <span class="text-[80px] font-black italic">NEXTBEE</span>
                            </div>
                            <div class="w-full h-full flex items-end gap-2 border-l border-b border-white/10 pb-2 pl-2">
                                <div class="flex-1 bg-blue-600/40 h-[30%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/40 h-[45%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/40 h-[40%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/40 h-[60%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/60 h-[75%] rounded-sm shadow-[0_0_15px_rgba(37,99,235,0.3)]"></div>
                                <div class="flex-1 bg-blue-600/40 h-[65%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/80 h-[90%] rounded-sm shadow-[0_0_25px_rgba(37,99,235,0.5)] animate-pulse"></div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase tracking-widest">
                            <span>Week 01</span><span>Week 02</span><span>Week 03</span><span>Current</span>
                        </div>
                    </div>
            
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-8">Category Profitability Matrix</h4>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-slate-900 uppercase italic">High-Volume Wholesale</span>
                                    <span class="text-blue-400">£142k</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-600 w-[75%] shadow-[0_0_10px_#2563eb]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-slate-900 uppercase italic">Retail Partner Orders</span>
                                    <span class="text-indigo-400">£86k</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-500 w-[55%]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-slate-900 uppercase italic">Direct Dispatch</span>
                                    <span class="text-emerald-400">£20k</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-500 w-[20%]"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 pt-6 border-t border-slate-200 flex justify-around text-center">
                            <div>
                                <p class="text-xl font-black italic text-slate-900">48</p>
                                <p class="text-[8px] text-slate-500 uppercase font-bold">New Leads</p>
                            </div>
                            <div class="border-x border-white/10 px-8">
                                <p class="text-xl font-black italic text-slate-900">12%</p>
                                <p class="text-[8px] text-slate-500 uppercase font-bold">Upsell Rate</p>
                            </div>
                            <div>
                                <p class="text-xl font-black italic text-slate-900">£7.4k</p>
                                <p class="text-[8px] text-slate-500 uppercase font-bold">Daily Avg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="pane-predictive" class="hidden grid lg:grid-cols-1 gap-8">
            <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-blue-900/5">

            
                <div class="grid md:grid-cols-4 gap-6 mb-12">
                    <div class="p-6 bg-gradient-to-br from-blue-600/10 to-transparent rounded-3xl border border-blue-500/20">
                        <p class="text-[9px] font-black text-blue-400 uppercase mb-3 tracking-widest">Gross Revenue (MTD)</p>
                        <p class="text-4xl metric-value text-slate-900">£248,520</p>
                        <div class="flex items-center gap-2 mt-3">
                            <span class="text-green-400 text-[10px] font-black italic">↑ 184% GROWTH </span>
                        </div>
                    </div>
                    <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                        <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Avg. Order Value (AOV)</p>
                        <p class="text-4xl metric-value text-slate-900">£1,840</p>
                        <p class="text-[9px] text-blue-400 font-bold mt-3 uppercase italic">"Larger Order Baskets Enabled"</p>
                    </div>
                    <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                        <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Sales Velocity Index</p>
                        <p class="text-4xl metric-value text-slate-900">8.4<span class="text-sm text-slate-500">/10</span></p>
                        <p class="text-[9px] text-slate-500 font-bold mt-3 uppercase italic">Optimized Cycle</p>
                    </div>
                    <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                        <p class="text-[9px] font-black text-slate-500 uppercase mb-3 tracking-widest">Retention Rate</p>
                        <p class="text-4xl metric-value text-slate-900">92%</p>
                        <p class="text-[9px] text-emerald-400 font-bold mt-3 uppercase italic">Intelligent Reordering</p>
                    </div>
                </div>
            
                <div class="grid lg:grid-cols-2 gap-8">
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                        <div class="flex justify-between items-center mb-8">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300">Revenue Velocity Trend</h4>
                            <span class="text-[10px] font-mono text-blue-500 uppercase italic">Live ERP Handshake</span>
                        </div>
                        <div class="h-64 flex items-end justify-between gap-1 px-2 relative">
                            <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                                <span class="text-[80px] font-black italic">NEXTBEE</span>
                            </div>
                            <div class="w-full h-full flex items-end gap-2 border-l border-b border-white/10 pb-2 pl-2">
                                <div class="flex-1 bg-blue-600/40 h-[30%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/40 h-[45%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/40 h-[40%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/40 h-[60%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/60 h-[75%] rounded-sm shadow-[0_0_15px_rgba(37,99,235,0.3)]"></div>
                                <div class="flex-1 bg-blue-600/40 h-[65%] rounded-sm"></div>
                                <div class="flex-1 bg-blue-600/80 h-[90%] rounded-sm shadow-[0_0_25px_rgba(37,99,235,0.5)] animate-pulse"></div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase tracking-widest">
                            <span>Week 01</span><span>Week 02</span><span>Week 03</span><span>Current</span>
                        </div>
                    </div>
            
                    <div class="glass-card p-8 rounded-[2rem] border-slate-200 bg-white">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-8">Category Profitability Matrix</h4>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-slate-900 uppercase italic">High-Volume Wholesale</span>
                                    <span class="text-blue-400">£142k</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-600 w-[75%] shadow-[0_0_10px_#2563eb]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-slate-900 uppercase italic">Retail Partner Orders</span>
                                    <span class="text-indigo-400">£86k</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-500 w-[55%]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-bold mb-2">
                                    <span class="text-slate-900 uppercase italic">Direct Dispatch</span>
                                    <span class="text-emerald-400">£20k</span>
                                </div>
                                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-500 w-[20%]"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 pt-6 border-t border-slate-200 flex justify-around text-center">
                            <div>
                                <p class="text-xl font-black italic text-slate-900">48</p>
                                <p class="text-[8px] text-slate-500 uppercase font-bold">New Leads</p>
                            </div>
                            <div class="border-x border-white/10 px-8">
                                <p class="text-xl font-black italic text-slate-900">12%</p>
                                <p class="text-[8px] text-slate-500 uppercase font-bold">Upsell Rate</p>
                            </div>
                            <div>
                                <p class="text-xl font-black italic text-slate-900">£7.4k</p>
                                <p class="text-[8px] text-slate-500 uppercase font-bold">Daily Avg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function switchTab(type) {
            const panes = ['realtime', 'historic', 'predictive'];
            panes.forEach(p => {
                document.getElementById('pane-' + p).classList.add('hidden');
                document.getElementById('tab-' + p).classList.remove('bg-blue-600', 'text-slate-900');
                document.getElementById('tab-' + p).classList.add('text-slate-500');
            });
            
            document.getElementById('pane-' + type).classList.remove('hidden');
            document.getElementById('tab-' + type).classList.add('bg-blue-600', 'text-slate-900');
            document.getElementById('tab-' + type).classList.remove('text-slate-500');
        }
    </script>
</div>

<div id="pane-customer" class="dashboard-pane hidden">
    <section id="customer-intelligence" class="lg:col-span-12 glass-card p-10 rounded-[3rem] border-red-500/20 mb-8">
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
    
        <div id="pane-realtime-risk" class="grid lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 glass-card p-8 rounded-[2rem] border-slate-200 bg-red-900/5">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-red-400 italic">Global Credit Exposure Map</h4>
                    <span class="status-pill status-risk">Real-Time Ledger Sync</span>
                </div>
                <div class="h-64 flex items-end gap-4 border-l border-b border-white/10 pb-2 pl-2">
                    <div class="flex-1 bg-red-600/60 h-[85%] rounded-t-lg shadow-[0_0_15px_rgba(239,68,68,0.3)]"></div>
                    <div class="flex-1 bg-red-600/40 h-[60%] rounded-t-lg"></div>
                    <div class="flex-1 bg-red-600/20 h-[30%] rounded-t-lg"></div>
                    <div class="flex-1 bg-red-600/80 h-[95%] rounded-t-lg animate-pulse"></div>
                </div>
                <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase italic">
                    <span>0-30 Days</span><span>31-60 Days</span><span>61-90 Days</span><span>90+ Overdue</span>
                </div>
            </div>
            <div class="lg:col-span-4 space-y-4">
                <div class="p-6 bg-red-500/10 rounded-3xl border border-red-500/20">
                    <p class="text-[9px] font-black text-red-400 uppercase mb-2">Total Outstanding Dues</p>
                    <p class="text-3xl font-black italic text-slate-900">£142,850</p>
                    <p class="text-[8px] text-slate-500 mt-2">"Monitor cash flow and credit limits in real-time."</p>
                </div>
                <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                    <p class="text-[9px] font-black text-slate-500 uppercase mb-3">Top At-Risk Accounts</p>
                    <div class="space-y-3">
                        <div class="flex justify-between text-[10px] font-bold italic">
                            <span class="text-slate-900">Global Mart</span>
                            <span class="text-red-500">£42,850</span>
                        </div>
                        <div class="flex justify-between text-[10px] font-bold italic">
                            <span class="text-slate-900">City Wholesale</span>
                            <span class="text-red-500">£12,400</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="pane-behavioral-trends" class="hidden grid lg:grid-cols-2 gap-8">
            <div class="glass-card p-8 rounded-[2rem] border-slate-200">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Ordering Consistency Analytics</h4>
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between text-[10px] font-bold mb-2">
                            <span class="text-slate-900 uppercase italic text-blue-400">Stable Ordering (72%)</span>
                            <span class="text-slate-500">£180k Volume</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 w-[72%]"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[10px] font-bold mb-2">
                            <span class="text-red-400 uppercase italic">Declining Frequency (18%)</span>
                            <span class="text-slate-500">£45k at risk</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-red-600 w-[18%]"></div>
                        </div>
                    </div>
                </div>
                <p class="mt-8 text-[9px] text-slate-500 italic font-medium">"Gauge exact customer interests and launch targeted campaigns."</p>
            </div>
            <div class="p-8 bg-slate-100 rounded-[2rem]">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Top Basket Growth Partners</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-blue-600/5 border border-blue-500/10 rounded-2xl">
                        <span class="text-xs font-bold italic">Regal Supplies</span>
                        <span class="text-green-400 font-bold text-xs">↑ 24% Basket Size</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-blue-600/5 border border-blue-500/10 rounded-2xl">
                        <span class="text-xs font-bold italic">The Corner Shop</span>
                        <span class="text-green-400 font-bold text-xs">↑ 12% Basket Size</span>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="pane-predictive-churn" class="hidden grid lg:grid-cols-1 gap-8">
            <div class="glass-card p-10 rounded-[2.5rem] border-purple-500/20 bg-purple-900/5 text-center">
                <div class="max-w-2xl mx-auto">
                    <div class="text-4xl mb-6">🔮</div>
                    <h4 class="text-2xl font-black text-slate-900 italic uppercase tracking-tighter mb-4">Neural Churn Prediction Active</h4>
                    <p class="text-slate-600 text-sm mb-10 leading-relaxed">
                        NextBee's AI has identified <span class="text-red-400 font-bold italic">12 shops</span> that are showing high-probability churn behavior. 
                        Targeted follow-ups have been automatically generated in the CRM.
                    </p>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="p-6 bg-black/40 rounded-3xl border border-purple-500/20">
                            <p class="text-[9px] font-black text-purple-400 uppercase mb-2">Revenue at Risk</p>
                            <p class="text-2xl font-black italic">£28,400</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-3xl border border-purple-500/20">
                            <p class="text-[9px] font-black text-purple-400 uppercase mb-2">AI Recovery Plan</p>
                            <p class="text-2xl font-black italic">Active</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-3xl border border-purple-500/20">
                            <p class="text-[9px] font-black text-purple-400 uppercase mb-2">Automated Alerts</p>
                            <p class="text-2xl font-black italic text-green-400">Sent</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        function switchRiskTab(type) {
            const panes = ['realtime-risk', 'behavioral-trends', 'predictive-churn'];
            panes.forEach(p => {
                document.getElementById('pane-' + p).classList.add('hidden');
                document.getElementById('tab-' + p).classList.remove('bg-red-600', 'text-slate-900');
                document.getElementById('tab-' + p).classList.add('text-slate-500');
            });
            
            document.getElementById('pane-' + type).classList.remove('hidden');
            document.getElementById('tab-' + type).classList.add('bg-red-600', 'text-slate-900');
            document.getElementById('tab-' + type).classList.remove('text-slate-500');
        }
    </script>
    <!-- YOUR CUSTOMER SECTION -->
</div>

<div id="pane-warehouse" class="dashboard-pane hidden">
    <!-- YOUR WAREHOUSE SECTION -->
    <section id="warehouse-intelligence" class="lg:col-span-12 glass-card p-10 rounded-[3rem] border-emerald-500/20 mb-8">
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
    
        <div id="pane-stock-live" class="grid lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 glass-card p-8 rounded-[2rem] border-slate-200 bg-emerald-900/5">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-emerald-400 italic">Inventory Throughput Matrix</h4>
                    <span class="status-pill status-live">Live ERP Sync Active</span>
                </div>
                <div class="h-64 flex items-end gap-3 border-l border-b border-white/10 pb-2 pl-2">
                    <div class="flex-1 bg-emerald-600/40 h-[65%] rounded-t-lg"></div>
                    <div class="flex-1 bg-emerald-600/60 h-[85%] rounded-t-lg shadow-[0_0_15px_rgba(16,185,129,0.3)]"></div>
                    <div class="flex-1 bg-emerald-600/30 h-[45%] rounded-t-lg"></div>
                    <div class="flex-1 bg-emerald-600/50 h-[75%] rounded-t-lg"></div>
                    <div class="flex-1 bg-emerald-600/80 h-[95%] rounded-t-lg animate-pulse"></div>
                </div>
                <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase italic">
                    <span>Bulk Goods</span><span>Fast Moving</span><span>Seasonal</span><span>Perishables</span><span>Reserve</span>
                </div>
            </div>
            <div class="lg:col-span-4 space-y-4">
                <div class="p-6 bg-emerald-500/10 rounded-3xl border border-emerald-500/20">
                    <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Total Inventory Value</p>
                    <p class="text-3xl font-black italic text-slate-900">£1.24M</p>
                    <p class="text-[8px] text-slate-500 mt-2">"Real-time financial oversight and inventory monitoring."</p>
                </div>
                <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                    <p class="text-[9px] font-black text-slate-500 uppercase mb-3">Critical Low Stock Alerts</p>
                    <div class="space-y-3">
                        <div class="flex justify-between text-[10px] font-bold italic">
                            <span class="text-slate-900">SKU-402 (Standard)</span>
                            <span class="text-red-500">24 Units Left</span>
                        </div>
                        <div class="flex justify-between text-[10px] font-bold italic text-slate-900">
                            <span>SKU-801 (Premium)</span>
                            <span class="text-red-500">12 Units Left</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="pane-aged-detail" class="hidden grid lg:grid-cols-2 gap-8">
            <div class="glass-card p-8 rounded-[2rem] border-slate-200">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Item Aging Risk Distribution</h4>
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between text-[10px] font-bold mb-2">
                            <span class="text-slate-900 uppercase italic text-emerald-400">Optimal Rotation (0-45 Days)</span>
                            <span class="text-slate-500">72% of Stock</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-600 w-[72%] shadow-[0_0_10px_#10b981]"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[10px] font-bold mb-2">
                            <span class="text-red-400 uppercase italic">Aging Risk (90+ Days)</span>
                            <span class="text-slate-500">12% at risk</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-red-600 w-[12%]"></div>
                        </div>
                    </div>
                </div>
                <p class="mt-8 text-[9px] text-slate-500 italic font-medium">"Set automatic promotional triggers to keep your inventory fresh." </p>
            </div>
            <div class="p-8 bg-slate-100 rounded-[2rem]">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Recommended Liquidations</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-red-600/5 border border-red-500/10 rounded-2xl">
                        <span class="text-xs font-bold italic">Inventory SKU-112</span>
                        <span class="text-red-400 font-bold text-xs">Aged: 104 Days</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-blue-600/5 border border-blue-500/10 rounded-2xl">
                        <span class="text-xs font-bold italic">AI Action: Triggered Flash Sale</span>
                        <span class="text-blue-400 font-bold text-xs">Apply 15% MARP</span>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="pane-auto-procure" class="hidden grid lg:grid-cols-1 gap-8">
            <div class="glass-card p-10 rounded-[2.5rem] border-blue-500/20 bg-blue-900/5 text-center">
                <div class="max-w-2xl mx-auto">
                    <div class="text-4xl mb-6">⚙️</div>
                    <h4 class="text-2xl font-black text-slate-900 italic uppercase tracking-tighter mb-4">Neural Auto-Procurement Logic</h4>
                    <p class="text-slate-600 text-sm mb-10 leading-relaxed">
                        NextBee's AI has automated procurement for <span class="text-emerald-400 font-bold italic">18 high-velocity items</span>. 
                        Reorder points are dynamically adjusted based on sales performance velocity.
                    </p>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="p-6 bg-black/40 rounded-3xl border border-emerald-500/20">
                            <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Automated POs Sent</p>
                            <p class="text-2xl font-black italic text-slate-900">12 Today</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-3xl border border-emerald-500/20">
                            <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Safety Stock Level</p>
                            <p class="text-2xl font-black italic text-slate-900">99.4%</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-3xl border border-emerald-500/20">
                            <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Procurement Savings</p>
                            <p class="text-2xl font-black italic text-green-400">£4.2k</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        function switchWarehouseTab(type) {
            const panes = ['stock-live', 'aged-detail', 'auto-procure'];
            panes.forEach(p => {
                document.getElementById('pane-' + p).classList.add('hidden');
                document.getElementById('tab-' + p).classList.remove('bg-emerald-600', 'text-slate-900');
                document.getElementById('tab-' + p).classList.add('text-slate-500');
            });
            
            document.getElementById('pane-' + type).classList.remove('hidden');
            document.getElementById('tab-' + type).classList.add('bg-emerald-600', 'text-slate-900');
            document.getElementById('tab-' + type).classList.remove('text-slate-500');
        }
    </script>
</div>

<div id="pane-logistics" class="dashboard-pane hidden">
    <!-- YOUR LOGISTICS SECTION -->
    <section id="logistics-intelligence" class="lg:col-span-12 glass-card p-10 rounded-[3rem] border-indigo-500/20 mb-8">
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
    
        <div id="pane-fleet-live" class="grid lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 glass-card p-8 rounded-[2rem] border-slate-200 bg-indigo-900/5">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-indigo-400 italic">Global Fleet Optimization Matrix</h4>
                    <span class="status-pill status-live">GPS Signal Active</span>
                </div>
                <div class="h-64 flex items-end gap-3 border-l border-b border-white/10 pb-2 pl-2">
                    <div class="flex-1 bg-indigo-600/40 h-[75%] rounded-t-lg"></div>
                    <div class="flex-1 bg-indigo-600/60 h-[90%] rounded-t-lg shadow-[0_0_15px_rgba(79,70,229,0.3)] animate-pulse"></div>
                    <div class="flex-1 bg-indigo-600/30 h-[55%] rounded-t-lg"></div>
                    <div class="flex-1 bg-indigo-600/50 h-[80%] rounded-t-lg"></div>
                    <div class="flex-1 bg-indigo-600/20 h-[45%] rounded-t-lg"></div>
                </div>
                <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-600 uppercase italic">
                    <span>Van A (North)</span><span>Van B (City)</span><span>Van C (East)</span><span>Van D (South)</span><span>Reserve 01</span>
                </div>
            </div>
            <div class="lg:col-span-4 space-y-4">
                <div class="p-6 bg-indigo-500/10 rounded-3xl border border-indigo-500/20">
                    <p class="text-[9px] font-black text-indigo-400 uppercase mb-2">Daily Route Efficiency</p>
                    <p class="text-3xl font-black italic text-slate-900">98.4%</p>
                    <p class="text-[8px] text-slate-500 mt-2">"App-based route optimization maximizing delivery velocity."</p>
                </div>
                <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200">
                    <p class="text-[9px] font-black text-slate-500 uppercase mb-3">Live Fleet Performance</p>
                    <div class="space-y-3">
                        <div class="flex justify-between text-[10px] font-bold italic">
                            <span class="text-slate-900">Active Deliveries</span>
                            <span class="text-blue-500">142</span>
                        </div>
                        <div class="flex justify-between text-[10px] font-bold italic">
                            <span class="text-slate-900">Avg. Drop Time</span>
                            <span class="text-blue-500">4.2m</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="pane-delivery-metrics" class="hidden grid lg:grid-cols-2 gap-8">
            <div class="glass-card p-8 rounded-[2rem] border-slate-200">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Delivery Integrity Index</h4>
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between text-[10px] font-bold mb-2">
                            <span class="text-slate-900 uppercase italic text-indigo-400">Digital POD Rate (100%)</span>
                            <span class="text-slate-500">Target: Universal</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-600 w-[100%] shadow-[0_0_10px_#4f46e5]"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[10px] font-bold mb-2">
                            <span class="text-emerald-400 uppercase italic">On-Time Fulfillment (96%)</span>
                            <span class="text-slate-500">Live Metric</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 w-[96%]"></div>
                        </div>
                    </div>
                </div>
                <p class="mt-8 text-[9px] text-slate-500 italic font-medium uppercase">"Seamless operations through digital proof of delivery."</p>
            </div>
            <div class="p-8 bg-slate-100 rounded-[2rem]">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Customer Acknowledgement Feed</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-emerald-600/5 border border-emerald-500/10 rounded-2xl">
                        <span class="text-xs font-bold italic">Store #402: Signature Received</span>
                        <span class="text-emerald-400 font-bold text-[8px] uppercase">Synced to ERP</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-blue-600/5 border border-blue-500/10 rounded-2xl">
                        <span class="text-xs font-bold italic">Outlet #109: Photo POD Verified</span>
                        <span class="text-blue-400 font-bold text-[8px] uppercase">Complete</span>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="pane-shortage-reports" class="hidden grid lg:grid-cols-1 gap-8">
            <div class="glass-card p-10 rounded-[2.5rem] border-red-500/20 bg-red-900/5 text-center">
                <div class="max-w-2xl mx-auto">
                    <div class="text-4xl mb-6">🛑</div>
                    <h4 class="text-2xl font-black text-slate-900 italic uppercase tracking-tighter mb-4">Real-Time Shortage Resolution</h4>
                    <p class="text-slate-600 text-sm mb-10 leading-relaxed">
                        NextBee’s Logistics Layer has detected <span class="text-red-400 font-bold italic">3 shortages</span> during live delivery. 
                        Financial credit notes have been automatically drafted in Xero/Sage.
                    </p>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="p-6 bg-black/40 rounded-3xl border border-red-500/20">
                            <p class="text-[9px] font-black text-red-400 uppercase mb-2">Shortages Detected</p>
                            <p class="text-2xl font-black italic text-slate-900">03 Today</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-3xl border border-red-500/20">
                            <p class="text-[9px] font-black text-red-400 uppercase mb-2">Revenue Leakage Guarded</p>
                            <p class="text-2xl font-black italic text-slate-900">£482.00</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-3xl border border-red-500/20">
                            <p class="text-[9px] font-black text-emerald-400 uppercase mb-2">Resolution Status</p>
                            <p class="text-2xl font-black italic text-green-400 italic">Automated</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        function switchLogisticsTab(type) {
            const panes = ['fleet-live', 'delivery-metrics', 'shortage-reports'];
            panes.forEach(p => {
                document.getElementById('pane-' + p).classList.add('hidden');
                document.getElementById('tab-' + p).classList.remove('bg-indigo-600', 'text-slate-900');
                document.getElementById('tab-' + p).classList.add('text-slate-500');
            });
            
            document.getElementById('pane-' + type).classList.remove('hidden');
            document.getElementById('tab-' + type).classList.add('bg-indigo-600', 'text-slate-900');
            document.getElementById('tab-' + type).classList.remove('text-slate-500');
        }
    </script>
    
</div>

   <div class="glass-card rounded-[2.5rem] overflow-hidden">
                           <h1 class="text-3xl md:text-4xl font-black italic uppercase tracking-tight text-slate-900 mb-6">
                            Inventory Control & Expiry Intelligence
                        </h1>
                <div class="p-8 bg-slate-50 border-b border-slate-200 flex justify-between items-center">

                    <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">02. Live Stock Adjustment & Expiry Protocol</h3>
                    <div class="flex gap-2">
                        <button onclick="cleanupExpired()" class="bg-red-50 text-red-600 px-4 py-2 rounded-lg text-[9px] font-black uppercase border border-red-100">Purge Expired Items</button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-100 border-b border-slate-200">
                            <tr>
                                <th class="p-5 text-[9px] font-black uppercase text-slate-400">Inventory Item</th>
                                <th class="p-5 text-[9px] font-black uppercase text-slate-400">Expiry Date</th>
                                <th class="p-5 text-[9px] font-black uppercase text-slate-400">Current Qty</th>
                                <th class="p-5 text-[9px] font-black uppercase text-slate-400">Adjustment</th>
                                <th class="p-5 text-center text-[9px] font-black uppercase text-slate-400">Protocol</th>
                            </tr>
                        </thead>
                        <tbody id="inventory-body" class="divide-y divide-slate-100">
                            </tbody>
                    </table>
                </div>
            </div>  
    
    

    
     <script>
        const stockItems = [
            { name: "Organic Hass Avocados", sku: "GR-2001", expiry: "2026-03-20", qty: 450 },
            { name: "Whole Milk 2L", sku: "GR-2002", expiry: "2026-03-28", qty: 1200 },
            { name: "Unsalted Butter 250g", sku: "GR-2003", expiry: "2026-05-15", qty: 800 },
            { name: "Free Range Eggs (Dozen)", sku: "GR-2004", expiry: "2026-03-21", qty: 300 },
            { name: "Mature Cheddar 400g", sku: "GR-2006", expiry: "2026-04-10", qty: 150 },
        
            // 🔥 Added Items
            { name: "Greek Yogurt 500g", sku: "GR-2007", expiry: "2026-03-26", qty: 220 },
            { name: "Frozen Chicken Breast", sku: "GR-2008", expiry: "2026-06-10", qty: 600 },
            { name: "Orange Juice 1L", sku: "GR-2009", expiry: "2026-03-24", qty: 340 },
            { name: "Spinach Pack", sku: "GR-2010", expiry: "2026-03-22", qty: 180 },
            { name: "Brown Bread Loaf", sku: "GR-2011", expiry: "2026-03-23", qty: 90 },
            { name: "Paneer Block 200g", sku: "GR-2012", expiry: "2026-03-27", qty: 260 }
        ];

        function renderInventory() {
            const body = document.getElementById('inventory-body');
            body.innerHTML = '';
            stockItems.forEach((item, index) => {
                const isExpired = new Date(item.expiry) < new Date();
                body.innerHTML += `
                    <tr class="${isExpired ? 'bg-red-50/50' : ''} hover:bg-slate-50 transition-colors">
                        <td class="p-5">
                            <p class="text-xs font-black italic text-slate-900 uppercase">${item.name}</p>
                            <p class="text-[8px] text-slate-400 font-bold tracking-widest uppercase">SKU: ${item.sku}</p>
                        </td>
                        <td class="p-5 text-xs font-bold ${isExpired ? 'text-red-600' : 'text-slate-600'} italic">
                            ${item.expiry} ${isExpired ? '[EXPIRED]' : ''}
                        </td>
                        <td class="p-5 text-xs font-black text-slate-900">${item.qty} Units</td>
                        <td class="p-5">
                            <div class="flex items-center gap-2">
                                <button onclick="adjustQty(${index}, -1)" class="w-8 h-8 rounded bg-white border border-slate-200 flex items-center justify-center font-bold hover:bg-slate-100">-</button>
                                <input type="number" value="0" class="w-16 p-1 text-center border rounded text-xs font-bold">
                                <button onclick="adjustQty(${index}, 1)" class="w-8 h-8 rounded bg-white border border-slate-200 flex items-center justify-center font-bold hover:bg-slate-100">+</button>
                            </div>
                        </td>
                        <td class="p-5 text-center">
                            <button onclick="removeItem(${index})" class="text-slate-300 hover:text-red-500 transition">ðŸ—‘ Remove</button>
                        </td>
                    </tr>
                `;
            });
        }

        function cleanupExpired() {
            if(confirm("PROTOCOL WARNING: Are you sure you want to purge all expired stock from the active ledger?")) {
                alert("ERP Alert: 2 Expired SKU batches purged from inventory.");
            }
        }

        function showSection(id) {
            const el = document.getElementById(id);
            el.classList.contains('hidden') ? el.classList.remove('hidden') : el.classList.add('hidden');
        }

        renderInventory();
    </script>
    
    
    <div class="glass-card rounded-[2.5rem] overflow-hidden mt-10">
        <h1 class="text-3xl md:text-4xl font-black italic uppercase tracking-tight text-slate-900 mb-6">
            Delivery Operations & Dispatch Control
        </h1>
                <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">01. Merchant Dispatch Queue</h3>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-[9px] font-black">3 PENDING DISPATCH</span>
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
                            </tr>
                        </thead>
                        <tbody id="dispatch-queue" class="divide-y divide-slate-100 bg-white">
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1005', 'Global Mart Ltd', '142KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600" checked></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1005</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">Global Mart Ltd</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">London (SE1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">50 Items / 142KG</td>
                            </tr>
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1012', 'City Wholesale', '88KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1012</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">City Wholesale</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">Manchester (M1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">32 Items / 88KG</td>
                            </tr>
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1015', 'Fresh Foods Co', '64KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1015</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">Fresh Foods Co</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">Birmingham (B1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">28 Items / 64KG</td>
                            </tr>
                            
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1018', 'Urban Retail Hub', '120KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1018</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">Urban Retail Hub</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">Leeds (LS1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">46 Items / 120KG</td>
                            </tr>
                            
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1021', 'Prime Wholesale Ltd', '95KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1021</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">Prime Wholesale Ltd</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">Liverpool (L1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">39 Items / 95KG</td>
                            </tr>
                            
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1025', 'Green Basket Store', '72KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1025</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">Green Basket Store</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">Bristol (BS1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">31 Items / 72KG</td>
                            </tr>
                            
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1029', 'Daily Needs Market', '54KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1029</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">Daily Needs Market</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">Sheffield (S1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">22 Items / 54KG</td>
                            </tr>
                            
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1033', 'Metro Supply Co', '140KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1033</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">Metro Supply Co</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">Nottingham (NG1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">58 Items / 140KG</td>
                            </tr>
                            
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1037', 'Corner Shop Express', '36KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1037</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">Corner Shop Express</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">Leicester (LE1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">18 Items / 36KG</td>
                            </tr>
                            
                            <tr class="hover:bg-indigo-50/30 transition-all cursor-pointer group" onclick="updateSelection(this, '#NB-1040', 'Value Mart UK', '110KG')">
                                <td class="p-5 text-center"><input type="radio" name="order" class="w-4 h-4 accent-indigo-600"></td>
                                <td class="p-5 text-xs font-black text-indigo-600">#NB-1040</td>
                                <td class="p-5 text-xs font-black italic uppercase text-slate-900">Value Mart UK</td>
                                <td class="p-5 text-[10px] font-bold text-slate-500 uppercase">Oxford (OX1)</td>
                                <td class="p-5 text-[10px] font-black text-slate-900 italic">44 Items / 110KG</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    
    
    <div class="mt-10">
        <h1 class="text-3xl md:text-4xl font-black italic uppercase tracking-tight text-slate-900 mb-6">
            Order Fulfillment & Delivery Overview
        </h1>
            <div class="glass-card rounded-[2.5rem] overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Order Ref</th>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Customer Profile</th>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Fulfillment Status</th>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Sync Date</th>
                            <th class="p-5 text-[10px] font-black uppercase text-slate-500 tracking-widest">Total Dues</th>
                            <th class="p-5 text-center text-[10px] font-black uppercase text-slate-500 tracking-widest">Drill-Down</th>
                        </tr>
                    </thead>
                    <tbody id="order-table-body" class="divide-y divide-slate-100 bg-white">
                        </tbody>
                </table>

                <div class="px-10 py-6 flex justify-between items-center bg-slate-50 border-t border-slate-200 hidden">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        Showing <span id="page-range" class="text-blue-600 italic">1-10</span> of 60 Orders
                    </p>
                    <div class="flex gap-2">
                        <button onclick="changePage(-1)" id="prev-btn" class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-white transition-all">←</button>
                        <div id="page-numbers" class="flex gap-2">
                            <button onclick="goToPage(1)" id="btn-p1" class="w-10 h-10 rounded-xl bg-blue-600 text-white font-black text-[10px] shadow-md">1</button>
                            <button onclick="goToPage(2)" id="btn-p2" class="w-10 h-10 rounded-xl border border-slate-200 text-slate-900 font-black text-[10px] hover:bg-white">2</button>
                            <button onclick="goToPage(3)" id="btn-p3" class="w-10 h-10 rounded-xl border border-slate-200 text-slate-900 font-black text-[10px] hover:bg-white">3</button>
                        </div>
                        <button onclick="changePage(1)" id="next-btn" class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-900 hover:bg-white">→</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
        const TOTAL_ORDERS = 10;
        const RECORDS_PER_PAGE = 10;
        let currentPage = 1;

        const customers = ["Global Mart Ltd", "City Wholesale", "Express Logistics", "Elite Retails", "Corner Shop Prime"];
        const statuses = ["Processing", "Dispatched", "Delivered", "Shortage Alert"];
        const colors = {"Processing": "blue", "Dispatched": "indigo", "Delivered": "green", "Shortage Alert": "red"};

        function renderOrders(page) {
            const tableBody = document.getElementById('order-table-body');
            const pageRange = document.getElementById('page-range');
            tableBody.innerHTML = '';

            const start = (page - 1) * RECORDS_PER_PAGE;
            const end = Math.min(start + RECORDS_PER_PAGE, TOTAL_ORDERS);
            pageRange.innerText = `${start + 1}-${end}`;

            for (let i = start + 1; i <= end; i++) {
                const status = statuses[i % 4];
                const row = `
                    <tr class="order-row transition-all cursor-pointer group" onclick="window.location.href='order-details.html'">
                        <td class="p-5 text-xs font-black text-blue-600 tracking-tighter">#NB-100${i}</td>
                        <td class="p-5">
                            <p class="text-xs font-black uppercase italic text-slate-900">${customers[i % 5]}</p>
                            <p class="text-[8px] text-slate-400 font-bold tracking-widest">ERP VERIFIED</p>
                        </td>
                        <td class="p-5">
                            <span class="px-3 py-1 rounded-full bg-${colors[status]}-50 text-${colors[status]}-600 text-[8px] font-black uppercase border border-${colors[status]}-100">
                                ${status}
                            </span>
                        </td>
                        <td class="p-5 text-[10px] font-bold text-slate-500 italic uppercase">March ${23 - (i % 20)}, 2026</td>
                        <td class="p-5 text-xs font-black text-slate-900 italic">£${(Math.random()*5000 + 500).toFixed(2)}</td>
                        <td class="p-5 text-center">
                            <div class="w-8 h-8 mx-auto rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">👁</div>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            }
            updatePaginationUI();
        }

        function updatePaginationUI() {
            const btn1 = document.getElementById('btn-p1');
            const btn2 = document.getElementById('btn-p2');
            const btn3 = document.getElementById('btn-p3');
            const btns = [btn1, btn2, btn3];
            
            btns.forEach((btn, idx) => {
                if (idx + 1 === currentPage) {
                    btn.className = "w-10 h-10 rounded-xl bg-blue-600 text-white font-black text-[10px] shadow-md transition-all";
                } else {
                    btn.className = "w-10 h-10 rounded-xl border border-slate-200 text-slate-900 font-black text-[10px] hover:bg-white transition-all";
                }
            });
        }

        function changePage(dir) {
            const newPage = currentPage + dir;
            if (newPage > 0 && newPage <= Math.ceil(TOTAL_ORDERS / RECORDS_PER_PAGE)) {
                currentPage = newPage;
                renderOrders(currentPage);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        function goToPage(p) {
            currentPage = p;
            renderOrders(p);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Initialize First 25 Records
        renderOrders(1);
    </script>
    
    
    <footer class="bg-slate-100 pt-24 pb-12 px-6 border-t border-slate-200">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-12 mb-20">
                <div class="col-span-2">
                    <div class="text-2xl font-black text-slate-900 uppercase italic mb-6">Next<span class="text-blue-500">Bee</span></div>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest leading-loose mb-8">
                        Streamlining Operations, <br>Maximizing Efficiency.
                    </p>
                    <div class="flex gap-4">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 border border-white/10 flex items-center justify-center hover:bg-blue-600 transition cursor-pointer italic font-bold">in</div>
                        <div class="w-8 h-8 rounded-lg bg-slate-100 border border-white/10 flex items-center justify-center hover:bg-blue-600 transition cursor-pointer italic font-bold">X</div>
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
                        <p class="text-slate-300 font-black text-xl italic">07879 175585 </p>
                        <p class="text-blue-400 font-bold text-sm tracking-widest">sales@thenexteck.com</p>
                        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.2em]">www.nextbee.nexteck.uk</p>
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
                <div class="text-[9px] font-black text-slate-700 uppercase tracking-widest">© 2026 NextBee. A Nexteck Enterprise Platform.</div>
            </div>
        </div>
    </footer>

</div>

<!-- JS -->
<script>
const sidebar = document.getElementById('sidebar');
const nav = document.getElementById('topNav');

sidebar.addEventListener('mouseenter', () => {
    nav.style.left = "260px";
});

sidebar.addEventListener('mouseleave', () => {
    nav.style.left = "80px";
});
</script>

</body>
</html>