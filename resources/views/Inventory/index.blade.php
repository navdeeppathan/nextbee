<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextBee B2B | Wholesale Groceries Command Center</title>
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

        /* Collapsed State */
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        /* Header Section */
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

        /* Toggle Button */
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

        /* Navigation Container */
        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        /* Menu Section */
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

        /* Navigation Items */
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

        /* Tooltip for collapsed state */
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

        /* Footer Section */
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

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Mobile Overlay */
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

        /* Glass effect for cards */
        .glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .expiry-urgent { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        .expiry-warning { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
        .expiry-good { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }

        /* Mobile Responsive */
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

        /* Keyboard focus styles for accessibility */
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
        <!-- Header -->
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

        <!-- Navigation -->
        <nav class="sidebar-nav">
            <!-- Operations Section -->
            <div class="menu-section" id="section-operations">
                <div class="section-header" onclick="toggleSection('section-operations')" tabindex="0" role="button" aria-expanded="true">
                    <span class="section-label">Operations</span>
                    <i class="fas fa-chevron-down section-chevron"></i>
                </div>
                <div class="section-content">
                    <a href="/inventory" class="nav-item active">
                        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                        <span class="nav-text">Dashboard</span>
                        <span class="tooltip">Dashboard</span>
                    </a>
                    <a href="/inventory-page" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-boxes"></i></span>
                        <span class="nav-text">Inventory</span>
                        <span class="nav-badge">47</span>
                        <span class="tooltip">Inventory</span>
                    </a>
                    <a href="/deliveries" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-truck"></i></span>
                        <span class="nav-text">Deliveries</span>
                        <span class="nav-badge warning">156</span>
                        <span class="tooltip">Deliveries</span>
                    </a>
                    <a href="/drivers" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-id-card"></i></span>
                        <span class="nav-text">Drivers</span>
                        <span class="tooltip">Drivers</span>
                    </a>
                </div>
            </div>

            <!-- Management Section -->
            <div class="menu-section" id="section-management">
                <div class="section-header" onclick="toggleSection('section-management')" tabindex="0" role="button" aria-expanded="true">
                    <span class="section-label">Management</span>
                    <i class="fas fa-chevron-down section-chevron"></i>
                </div>
                <div class="section-content">
                    <a href="/customers" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-store"></i></span>
                        <span class="nav-text">Customers</span>
                        <span class="tooltip">Customers</span>
                    </a>
                    <a href="/returns" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-undo-alt"></i></span>
                        <span class="nav-text">Returns</span>
                        <span class="nav-badge warning">3</span>
                        <span class="tooltip">Returns</span>
                    </a>
                </div>
            </div>

            <!-- Sales Portal Section -->
            <div class="menu-section" id="section-sales">
                <div class="section-header" onclick="toggleSection('section-sales')" tabindex="0" role="button" aria-expanded="true">
                    <span class="section-label">Sales Portal</span>
                    <i class="fas fa-chevron-down section-chevron"></i>
                </div>
                <div class="section-content">
                    <a href="/sales-dashboard" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
                        <span class="nav-text">Sales Dashboard</span>
                        <span class="tooltip">Sales Dashboard</span>
                    </a>
                    <a href="/sales-order" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                        <span class="nav-text">Sales Orders</span>
                        <span class="tooltip">Sales Orders</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Footer -->
        <div class="sidebar-footer">
            <div class="user-profile" onclick="openProfile()" title="View Profile">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" alt="Admin User" class="user-avatar">
                <div class="user-info">
                    <p class="user-name">Admin User</p>
                    <p class="user-role">Operations Manager</p>
                </div>
            </div>
             <form method="POST" action="{{ url('/logout') }}">
                 @csrf
                <button class="logout-btn" type="submit" aria-label="Logout">

            {{-- <button class="logout-btn" onclick="logout()" aria-label="Logout"> --}}
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-4">
                    <button class="mobile-toggle p-2 hover:bg-slate-100 rounded-lg" onclick="openMobileSidebar()" aria-label="Open menu">
                        <i class="fas fa-bars text-slate-600 text-xl"></i>
                    </button>
                    <div>
                        <h1 class="font-display text-2xl font-bold text-slate-900">Command Center</h1>
                        <p class="text-sm text-slate-500">Real-time operations overview</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-slate-500" id="current-date"></span>
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

        <div class="p-6">
            <!-- Header Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total SKUs</div>
                        <span class="text-blue-600 text-xs font-semibold bg-blue-50 px-2 py-1 rounded">Live</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-900 font-display">2,847</div>
                    <div class="text-xs text-slate-500 mt-1">Across 12 categories</div>
                </div>
                <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Expiring Soon</div>
                        <span class="text-red-600 text-xs font-semibold bg-red-50 px-2 py-1 rounded">Alert</span>
                    </div>
                    <div class="text-3xl font-bold text-red-600 font-display">47</div>
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
                    <div class="text-3xl font-bold text-amber-600 font-display">18</div>
                    <div class="text-xs text-slate-500 mt-1">Below MOQ threshold</div>
                </div>
            </div>

            <!-- Critical Alerts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Expiry Alerts -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
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
                </div>

                <!-- Delivery Status -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
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
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="inventory.html" class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-blue-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition">📦</div>
                    <p class="text-sm font-bold text-slate-900">Manage Inventory</p>
                    <p class="text-xs text-slate-500 mt-1">Stock & locations</p>
                </a>
                <a href="deliveries.html" class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition">🚚</div>
                    <p class="text-sm font-bold text-slate-900">Daily Deliveries</p>
                    <p class="text-xs text-slate-500 mt-1">Routes & tracking</p>
                </a>
                <a href="returns.html" class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-red-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition">↩️</div>
                    <p class="text-sm font-bold text-slate-900">Process Returns</p>
                    <p class="text-xs text-slate-500 mt-1">3 pending approvals</p>
                </a>
                <a href="customers.html" class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-purple-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition">🏪</div>
                    <p class="text-sm font-bold text-slate-900">B2B Customers</p>
                    <p class="text-xs text-slate-500 mt-1">247 active accounts</p>
                </a>
            </div>
        </div>
    </main>

    <script>
        // ===== SIDEBAR COLLAPSE FUNCTIONALITY =====

        // Initialize sidebar state from localStorage
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            
            if (isCollapsed && window.innerWidth > 1024) {
                sidebar.classList.add('collapsed');
            }
            
            // Initialize section states from localStorage
            const sections = ['section-operations', 'section-management', 'section-sales'];
            sections.forEach(sectionId => {
                const isSectionCollapsed = localStorage.getItem(sectionId + '_collapsed') === 'true';
                if (isSectionCollapsed) {
                    document.getElementById(sectionId).classList.add('collapsed');
                }
            });

            // Set current date
            document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-GB', { 
                weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' 
            });
        });

        // Toggle sidebar collapse (desktop only)
        function toggleSidebar() {
            if (window.innerWidth <= 1024) return;
            
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            
            // Save state to localStorage
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        // Toggle menu sections (accordion style)
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            const isCollapsed = section.classList.toggle('collapsed');
            
            // Save state to localStorage
            localStorage.setItem(sectionId + '_collapsed', isCollapsed);
            
            // Update aria-expanded for accessibility
            const header = section.querySelector('.section-header');
            header.setAttribute('aria-expanded', !isCollapsed);
        }

        // ===== MOBILE SIDEBAR =====

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

        // Close mobile sidebar on window resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                closeMobileSidebar();
            }
        });

        // ===== KEYBOARD ACCESSIBILITY =====

        // Allow keyboard navigation for section headers
        document.querySelectorAll('.section-header').forEach(header => {
            header.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });

        // Escape key to close mobile sidebar
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMobileSidebar();
            }
        });

        // ===== COMMON FUNCTIONS =====

        function openProfile() {
            // Implement profile modal or navigation
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