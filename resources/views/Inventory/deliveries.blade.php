<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Management | NextBee B2B</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --navy: #0f172a;
            --royal: #1e40af;
            --gold: #d4af37;
            --emerald: #059669;
            --crimson: #dc2626;
            --amber: #f59e0b;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 64px;
            --transition-speed: 250ms;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* ===== SIDEBAR STYLES ===== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--navy);
            z-index: 50;
            transition: width var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.2) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255,255,255,0.2);
            border-radius: 3px;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 80px;
        }

        .brand-container {
            display: flex;
            align-items: center;
            gap: 12px;
            overflow: hidden;
            white-space: nowrap;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .brand-text {
            opacity: 1;
            transition: opacity var(--transition-speed) ease;
        }

        .sidebar.collapsed .brand-text {
            opacity: 0;
            width: 0;
        }

        .sidebar-toggle {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255,255,255,0.1);
            border: none;
            color: #94a3b8;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .sidebar-toggle:hover {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .sidebar.collapsed .sidebar-toggle {
            transform: rotate(180deg);
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .menu-section {
            margin-bottom: 8px;
        }

        .section-header {
            padding: 8px 16px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            border-radius: 6px;
            transition: all 0.2s ease;
            user-select: none;
        }

        .section-header:hover {
            background: rgba(255,255,255,0.05);
            color: #94a3b8;
        }

        .section-chevron {
            transition: transform 0.2s ease;
            font-size: 12px;
        }

        .menu-section.collapsed .section-chevron {
            transform: rotate(-90deg);
        }

        .sidebar.collapsed .section-header {
            justify-content: center;
            padding: 8px;
        }

        .sidebar.collapsed .section-label {
            display: none;
        }

        .section-content {
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .menu-section.collapsed .section-content {
            max-height: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            margin: 2px 0;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--royal);
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        .nav-item.active {
            background: rgba(30, 64, 175, 0.2);
            color: white;
            font-weight: 500;
        }

        .nav-item.active::before {
            opacity: 1;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 16px;
        }

        .nav-text {
            flex: 1;
            font-size: 14px;
            opacity: 1;
            transition: opacity var(--transition-speed) ease;
        }

        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .nav-badge {
            opacity: 0;
            width: 0;
            display: none;
        }

        .nav-badge {
            background: var(--crimson);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 12px;
            flex-shrink: 0;
            transition: opacity var(--transition-speed) ease;
        }

        .nav-badge.warning {
            background: var(--amber);
        }

        .tooltip {
            position: absolute;
            left: calc(var(--sidebar-collapsed-width) + 12px);
            background: #1e293b;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            z-index: 100;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            pointer-events: none;
        }

        .tooltip::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 6px 6px 6px 0;
            border-color: transparent #1e293b transparent transparent;
        }

        .sidebar.collapsed .nav-item:hover .tooltip {
            opacity: 1;
            visibility: visible;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: auto;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.2s ease;
            cursor: pointer;
        }

        .user-profile:hover {
            background: rgba(255,255,255,0.05);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.2);
            flex-shrink: 0;
        }

        .user-info {
            overflow: hidden;
            opacity: 1;
            transition: opacity var(--transition-speed) ease;
        }

        .sidebar.collapsed .user-info {
            opacity: 0;
            width: 0;
            display: none;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: white;
            white-space: nowrap;
        }

        .user-role {
            font-size: 12px;
            color: #94a3b8;
            white-space: nowrap;
        }

        .logout-btn {
            width: 100%;
            margin-top: 12px;
            padding: 10px;
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: #94a3b8;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .sidebar.collapsed .logout-btn span {
            display: none;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            background: #f1f5f9;
        }

        body.sidebar-is-collapsed .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .mobile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .route-card { border-left: 4px solid; }
        .route-completed { border-left-color: #10b981; }
        .route-active { border-left-color: #3b82f6; }
        .route-pending { border-left-color: #f59e0b; }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width) !important;
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .sidebar.collapsed {
                width: var(--sidebar-width) !important;
            }

            .main-content {
                margin-left: 0 !important;
            }

            body.sidebar-is-collapsed .main-content {
                margin-left: 0 !important;
            }

            .sidebar-toggle {
                display: none;
            }

            .mobile-toggle {
                display: flex !important;
            }
        }

        @media (min-width: 1025px) {
            .mobile-toggle {
                display: none !important;
            }
        }

        .nav-item:focus-visible,
        .section-header:focus-visible,
        .sidebar-toggle:focus-visible,
        .logout-btn:focus-visible {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="brand-container">
                <div class="brand-icon">
                    <i class="fas fa-building text-white text-lg"></i>
                </div>
                <div class="brand-text">
                    <h1 class="font-display text-xl font-bold text-white tracking-tight">NextBee</h1>
                    <p class="text-xs text-slate-400 font-medium">B2B Command Center</p>
                </div>
            </div>
            <button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle sidebar" title="Collapse menu">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <div class="menu-section" id="section-operations">
                <div class="section-header" onclick="toggleSection('section-operations')" tabindex="0" role="button" aria-expanded="true">
                    <span class="section-label">Operations</span>
                    <i class="fas fa-chevron-down section-chevron"></i>
                </div>
                <div class="section-content">
                    <a href="index.html" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                        <span class="nav-text">Dashboard</span>
                        <span class="tooltip">Dashboard</span>
                    </a>
                    <a href="inventory.html" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-boxes"></i></span>
                        <span class="nav-text">Inventory</span>
                        <span class="nav-badge">47</span>
                        <span class="tooltip">Inventory</span>
                    </a>
                    <a href="deliveries.html" class="nav-item active">
                        <span class="nav-icon"><i class="fas fa-truck"></i></span>
                        <span class="nav-text">Deliveries</span>
                        <span class="nav-badge warning">156</span>
                        <span class="tooltip">Deliveries</span>
                    </a>
                    <a href="drivers.html" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-id-card"></i></span>
                        <span class="nav-text">Drivers</span>
                        <span class="tooltip">Drivers</span>
                    </a>
                </div>
            </div>

            <div class="menu-section" id="section-management">
                <div class="section-header" onclick="toggleSection('section-management')" tabindex="0" role="button" aria-expanded="true">
                    <span class="section-label">Management</span>
                    <i class="fas fa-chevron-down section-chevron"></i>
                </div>
                <div class="section-content">
                    <a href="customers.html" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-store"></i></span>
                        <span class="nav-text">Customers</span>
                        <span class="tooltip">Customers</span>
                    </a>
                    <a href="returns.html" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-undo-alt"></i></span>
                        <span class="nav-text">Returns</span>
                        <span class="nav-badge warning">3</span>
                        <span class="tooltip">Returns</span>
                    </a>
                </div>
            </div>

            <div class="menu-section" id="section-sales">
                <div class="section-header" onclick="toggleSection('section-sales')" tabindex="0" role="button" aria-expanded="true">
                    <span class="section-label">Sales Portal</span>
                    <i class="fas fa-chevron-down section-chevron"></i>
                </div>
                <div class="section-content">
                    <a href="sales_dashboard.html" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
                        <span class="nav-text">Sales Dashboard</span>
                        <span class="tooltip">Sales Dashboard</span>
                    </a>
                    <a href="sales_orders.html" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                        <span class="nav-text">Sales Orders</span>
                        <span class="tooltip">Sales Orders</span>
                    </a>
                </div>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile" onclick="openProfile()" title="View Profile">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" alt="Admin User" class="user-avatar">
                <div class="user-info">
                    <p class="user-name">Admin User</p>
                    <p class="user-role">Operations Manager</p>
                </div>
            </div>
            <button class="logout-btn" onclick="logout()" aria-label="Logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </div>
    </aside>

    <main class="main-content">
        <!-- Header -->
        <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-4">
                    <button class="mobile-toggle p-2 hover:bg-slate-100 rounded-lg" onclick="openMobileSidebar()" aria-label="Open menu">
                        <i class="fas fa-bars text-slate-600 text-xl"></i>
                    </button>
                    <div>
                        <h1 class="font-display text-2xl font-bold text-slate-900">Delivery Management</h1>
                        <p class="text-sm text-slate-500">Manage routes, track drivers, and confirm deliveries</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button class="bg-emerald-600 hover:bg-emerald-500 px-4 py-2 rounded-lg text-sm font-semibold text-white transition">
                        + New Route
                    </button>
                    <button class="relative p-2 text-slate-600 hover:text-blue-900 transition" aria-label="Notifications">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">8</span>
                    </button>
                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-sm font-bold text-slate-700 border-2 border-white shadow">
                        AD
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="p-6">
            <!-- Date Selector & Stats -->
            <div class="card p-6 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 font-display mb-1">Daily Delivery Schedule</h2>
                        <p class="text-sm text-slate-500">Manage routes, track drivers, and confirm deliveries</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm text-slate-700 transition">← Prev</button>
                        <input type="date" class="bg-white border border-slate-300 rounded-lg px-4 py-2 text-sm text-slate-900 focus:outline-none focus:border-blue-500" value="2026-04-01">
                        <button class="px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm text-slate-700 transition">Next →</button>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <div class="text-center p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <p class="text-2xl font-bold text-slate-900 font-display">23</p>
                        <p class="text-xs text-slate-500 uppercase font-medium mt-1">Active Drivers</p>
                    </div>
                    <div class="text-center p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <p class="text-2xl font-bold text-slate-900 font-display">156</p>
                        <p class="text-xs text-slate-500 uppercase font-medium mt-1">Total Stops</p>
                    </div>
                    <div class="text-center p-4 bg-emerald-50 rounded-xl border border-emerald-200">
                        <p class="text-2xl font-bold text-emerald-600 font-display">89</p>
                        <p class="text-xs text-emerald-600 uppercase font-medium mt-1">Completed</p>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-xl border border-blue-200">
                        <p class="text-2xl font-bold text-blue-600 font-display">42</p>
                        <p class="text-xs text-blue-600 uppercase font-medium mt-1">In Progress</p>
                    </div>
                    <div class="text-center p-4 bg-amber-50 rounded-xl border border-amber-200">
                        <p class="text-2xl font-bold text-amber-600 font-display">25</p>
                        <p class="text-xs text-amber-600 uppercase font-medium mt-1">Pending</p>
                    </div>
                </div>
            </div>

            <!-- Routes Grid -->
            <div class="grid lg:grid-cols-3 gap-6">
                
                <!-- Route 1: Active -->
                <div class="card overflow-hidden route-active">
                    <div class="p-6 border-b border-slate-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Route A-04</h3>
                                <p class="text-xs text-slate-500">North London Circuit</p>
                            </div>
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">Active</span>
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm">JD</div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">John Davies</p>
                                <p class="text-xs text-slate-500">VAN-04 • 07879 123456</p>
                            </div>
                        </div>
                        <div class="flex justify-between text-xs text-slate-500 mb-2">
                            <span>Progress: 8/12 stops</span>
                            <span class="text-blue-600 font-semibold">67%</span>
                        </div>
                        <div class="h-2 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 w-[67%]"></div>
                        </div>
                    </div>
                    
                    <div class="p-4 space-y-2 max-h-64 overflow-y-auto">
                        <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-lg border border-emerald-200">
                            <span class="text-emerald-600 text-lg">✓</span>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-slate-900">Tesco Express Camden</p>
                                <p class="text-xs text-slate-500">Delivered 10:23 AM</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-lg border border-emerald-200">
                            <span class="text-emerald-600 text-lg">✓</span>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-slate-900">Sainsbury's Local Kentish</p>
                                <p class="text-xs text-slate-500">Delivered 10:45 AM</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <span class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs animate-pulse">●</span>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-slate-900">Costcutter Highbury</p>
                                <p class="text-xs text-blue-600">Arriving in 5 min</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-slate-100 rounded-lg border border-slate-200 opacity-50">
                            <span class="text-slate-400 text-xs font-bold">4</span>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-500">Premier Shop Islington</p>
                                <p class="text-xs text-slate-400">Pending</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 border-t border-slate-200 bg-slate-50">
                        <button onclick="document.getElementById('delivery-detail').classList.remove('hidden')" 
                                class="w-full py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg text-sm font-semibold hover:bg-blue-100 transition">
                            View Details & Items
                        </button>
                    </div>
                </div>

                <!-- Route 2: Loading -->
                <div class="card overflow-hidden route-pending">
                    <div class="p-6 border-b border-slate-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Route B-12</h3>
                                <p class="text-xs text-slate-500">East London Circuit</p>
                            </div>
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">Loading</span>
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 font-bold text-sm">SM</div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Sarah Miller</p>
                                <p class="text-xs text-slate-500">VAN-12 • 07879 234567</p>
                            </div>
                        </div>
                        <div class="flex justify-between text-xs text-slate-500 mb-2">
                            <span>Stops: 15 total</span>
                            <span class="text-amber-600 font-semibold">Departs 11:30 AM</span>
                        </div>
                        <div class="h-2 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 w-[0%]"></div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="space-y-2">
                            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <span class="text-xs text-slate-500">Items Loaded</span>
                                <span class="text-sm font-bold text-slate-900">142/156</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <span class="text-xs text-slate-500">Est. Duration</span>
                                <span class="text-sm font-bold text-slate-900">6.5 hours</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <span class="text-xs text-slate-500">Route Efficiency</span>
                                <span class="text-sm font-bold text-emerald-600">94%</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 border-t border-slate-200 bg-slate-50">
                        <button class="w-full py-2 bg-amber-50 text-amber-700 border border-amber-200 rounded-lg text-sm font-semibold hover:bg-amber-100 transition">
                            Monitor Loading
                        </button>
                    </div>
                </div>

                <!-- Route 3: Completed -->
                <div class="card overflow-hidden route-completed">
                    <div class="p-6 border-b border-slate-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Route C-07</h3>
                                <p class="text-xs text-slate-500">Central London Circuit</p>
                            </div>
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">Completed</span>
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-sm">RK</div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Robert King</p>
                                <p class="text-xs text-slate-500">VAN-07 • 07879 345678</p>
                            </div>
                        </div>
                        <div class="flex justify-between text-xs text-slate-500 mb-2">
                            <span>All 10 stops completed</span>
                            <span class="text-emerald-600 font-semibold">100%</span>
                        </div>
                        <div class="h-2 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 w-full"></div>
                        </div>
                    </div>
                    
                    <div class="p-4 space-y-2">
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500">Completion Time</span>
                            <span class="text-sm font-bold text-slate-900">4h 23m</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500">Items Delivered</span>
                            <span class="text-sm font-bold text-slate-900">98</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500">Customer Confirmations</span>
                            <span class="text-sm font-bold text-emerald-600">10/10</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg border border-red-200">
                            <span class="text-xs text-red-600">Returns Collected</span>
                            <span class="text-sm font-bold text-red-600">3 items</span>
                        </div>
                    </div>

                    <div class="p-4 border-t border-slate-200 bg-slate-50">
                        <button class="w-full py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg text-sm font-semibold transition">
                            View Report
                        </button>
                    </div>
                </div>

            </div>

            <!-- Delivery Items Detail Modal -->
            <div id="delivery-detail" class="hidden fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                <div class="bg-white rounded-3xl p-8 max-w-4xl w-full max-h-[90vh] overflow-y-auto border border-slate-200 shadow-2xl">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">Route A-04 Delivery Details</h2>
                            <p class="text-sm text-slate-500">Stop #3: Costcutter Highbury</p>
                        </div>
                        <button onclick="document.getElementById('delivery-detail').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <p class="text-xs text-slate-500 uppercase font-medium mb-2">Customer</p>
                            <p class="text-lg font-bold text-slate-900">Costcutter Highbury</p>
                            <p class="text-sm text-slate-600">123 Highbury Park, N5 1AB</p>
                            <p class="text-sm text-slate-600">Contact: Ahmed Hassan • 020 7123 4567</p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <p class="text-xs text-slate-500 uppercase font-medium mb-2">Delivery Status</p>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                                <span class="text-blue-600 font-semibold">Driver Arriving</span>
                            </div>
                            <p class="text-xs text-slate-500">ETA: 11:05 AM (5 minutes)</p>
                        </div>
                    </div>

                    <h3 class="text-sm font-bold text-slate-900 uppercase mb-4">Items to Deliver</h3>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <div class="flex items-center gap-4">
                                <span class="text-2xl">🥛</span>
                                <div>
                                    <p class="font-semibold text-slate-900">Fresh Whole Milk 2L</p>
                                    <p class="text-xs text-slate-500">Lot: M240401-A • Exp: Today</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-slate-900">Qty: 24</span>
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs rounded-full font-bold">URGENT</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <div class="flex items-center gap-4">
                                <span class="text-2xl">🥚</span>
                                <div>
                                    <p class="font-semibold text-slate-900">Free-Range Eggs (12pk)</p>
                                    <p class="text-xs text-slate-500">Lot: E240331-B • Exp: Tomorrow</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-slate-900">Qty: 12</span>
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs rounded-full font-bold">WARNING</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <div class="flex items-center gap-4">
                                <span class="text-2xl">🍞</span>
                                <div>
                                    <p class="font-semibold text-slate-900">Sliced White Bread</p>
                                    <p class="text-xs text-slate-500">Lot: B240401-X • Exp: 5 days</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-slate-900">Qty: 18</span>
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs rounded-full font-bold">GOOD</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-500 rounded-lg text-white font-semibold transition flex items-center justify-center gap-2">
                            <span>✓</span> Confirm Delivery
                        </button>
                        <button class="flex-1 py-3 bg-red-50 text-red-600 border border-red-200 rounded-lg font-semibold hover:bg-red-100 transition">
                            Report Shortage
                        </button>
                        <button onclick="document.getElementById('delivery-detail').classList.add('hidden')" class="px-6 py-3 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-100 transition">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // ===== SIDEBAR COLLAPSE FUNCTIONALITY =====

        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const body = document.body;
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            
            if (isCollapsed && window.innerWidth > 1024) {
                sidebar.classList.add('collapsed');
                body.classList.add('sidebar-is-collapsed');
            }
            
            const sections = ['section-operations', 'section-management', 'section-sales'];
            sections.forEach(sectionId => {
                const isSectionCollapsed = localStorage.getItem(sectionId + '_collapsed') === 'true';
                if (isSectionCollapsed) {
                    document.getElementById(sectionId).classList.add('collapsed');
                }
            });
        });

        function toggleSidebar() {
            if (window.innerWidth <= 1024) return;
            
            const sidebar = document.getElementById('sidebar');
            const body = document.body;
            
            sidebar.classList.toggle('collapsed');
            body.classList.toggle('sidebar-is-collapsed');
            
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            const isCollapsed = section.classList.toggle('collapsed');
            
            localStorage.setItem(sectionId + '_collapsed', isCollapsed);
            
            const header = section.querySelector('.section-header');
            header.setAttribute('aria-expanded', !isCollapsed);
        }

        function openMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');
            
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');
            
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                closeMobileSidebar();
            }
        });

        document.querySelectorAll('.section-header').forEach(header => {
            header.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMobileSidebar();
            }
        });

        function openProfile() {
            console.log('Opening profile...');
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'login.html';
            }
        }
    </script>
</body>
</html>