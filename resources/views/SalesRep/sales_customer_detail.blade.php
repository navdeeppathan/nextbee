<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details | Sales Rep Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <h1 class="font-display text-xl font-bold text-white tracking-tight">METRO</h1>
                <p class="text-xs text-slate-400 font-medium">Sales Portal</p>
            </div>
        </div>
        <button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle sidebar" title="Collapse menu">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <!-- Main Section -->
        <div class="menu-section" id="section-main">
            <div class="section-header" onclick="toggleSection('section-main')" tabindex="0" role="button" aria-expanded="true">
                <span class="section-label">Main</span>
                <i class="fas fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-content">
                <a href="/sales-dashboard" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                    <span class="nav-text">Dashboard</span>
                    <span class="tooltip">Dashboard</span>
                </a>
                <a href="/sales-customers" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-users"></i></span>
                    <span class="nav-text">My Customers</span>
                    <span class="nav-badge">3</span>
                    <span class="tooltip">My Customers</span>
                </a>
                <a href="/sales-orders" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                    <span class="nav-text">All Orders</span>
                    <span class="tooltip">All Orders</span>
                </a>
                <a href="/sales-tasks" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-tasks"></i></span>
                    <span class="nav-text">Tasks</span>
                    <span class="nav-badge warning">5</span>
                    <span class="tooltip">Tasks</span>
                </a>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="menu-section" id="section-analytics">
            <div class="section-header" onclick="toggleSection('section-analytics')" tabindex="0" role="button" aria-expanded="true">
                <span class="section-label">Analytics</span>
                <i class="fas fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-content">
                <a href="/sales-performance" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
                    <span class="nav-text">Performance</span>
                    <span class="tooltip">Performance</span>
                </a>
                <a href="/sales-commissions" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-pound-sign"></i></span>
                    <span class="nav-text">Commissions</span>
                    <span class="tooltip">Commissions</span>
                </a>
                <a href="/sales-target" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-bullseye"></i></span>
                    <span class="nav-text">Targets</span>
                    <span class="tooltip">Targets</span>
                </a>
            </div>
        </div>

        <!-- Tools Section -->
        <div class="menu-section" id="section-tools">
            <div class="section-header" onclick="toggleSection('section-tools')" tabindex="0" role="button" aria-expanded="true">
                <span class="section-label">Tools</span>
                <i class="fas fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-content">
                <a href="sales_price_lists.html" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-file-invoice"></i></span>
                    <span class="nav-text">Price Lists</span>
                    <span class="tooltip">Price Lists</span>
                </a>
                <a href="sales_catalog.html" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-box-open"></i></span>
                    <span class="nav-text">Product Catalog</span>
                    <span class="tooltip">Product Catalog</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Footer -->
    <div class="sidebar-footer">
        <div class="user-profile" onclick="openProfile()" title="View Profile">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" alt="Mike Thompson" class="user-avatar">
            <div class="user-info">
                <p class="user-name">Mike Thompson</p>
                <p class="user-role">Senior Sales Rep</p>
            </div>
        </div>
        <button class="logout-btn" onclick="logout()" aria-label="Logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </div>
</aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                        <i class="fas fa-bars text-slate-600"></i>
                    </button>
                    <div class="flex items-center gap-3">
                        <button onclick="history.back()" class="p-2 hover:bg-slate-100 rounded-lg">
                            <i class="fas fa-arrow-left text-slate-600"></i>
                        </button>
                        <div>
                            <h1 class="font-display text-2xl font-bold text-slate-900">London Bistro Ltd</h1>
                            <p class="text-sm text-slate-500">Customer ID: CLB-001 • Gold Tier</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="createOrder()" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        New Order
                    </button>
                    <button onclick="scheduleCall()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center gap-2">
                        <i class="fas fa-phone"></i>
                        Call Now
                    </button>
                </div>
            </div>
        </header>

        <div class="p-6">
            <!-- Alert Banner -->
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-red-900">Order Reduction Alert</p>
                        <p class="text-sm text-red-700">This customer's orders have decreased by 45% compared to their 3-month average. Immediate attention required.</p>
                    </div>
                </div>
                <button onclick="viewAnalysis()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm">
                    View Analysis
                </button>
            </div>

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Left Column: Customer Info & Stats -->
                <div class="space-y-6">
                    <!-- Customer Card -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-900 font-bold text-2xl">
                                LB
                            </div>
                            <div>
                                <h2 class="font-semibold text-slate-900">London Bistro Ltd</h2>
                                <p class="text-sm text-slate-500">Restaurant & Catering</p>
                            </div>
                        </div>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user text-slate-400 w-5"></i>
                                <span>James Wilson (Owner)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-phone text-slate-400 w-5"></i>
                                <span>020 7946 0123</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope text-slate-400 w-5"></i>
                                <span>james@londonbistro.co.uk</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-slate-400 w-5"></i>
                                <span>45 High Street, London W1B 1EG</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-slate-500">Customer Since</span>
                                <span class="text-sm font-medium">March 2022</span>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-slate-500">Payment Terms</span>
                                <span class="text-sm font-medium">Net 30</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-500">Credit Limit</span>
                                <span class="text-sm font-medium">£25,000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Performance Metrics</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-500">Total Revenue (YTD)</span>
                                    <span class="font-semibold">£34,250</span>
                                </div>
                                <div class="h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 bg-blue-900 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-500">Avg Order Value</span>
                                    <span class="font-semibold">£8,500</span>
                                </div>
                                <div class="h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 bg-emerald-500 rounded-full" style="width: 80%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-500">Order Frequency</span>
                                    <span class="font-semibold">Weekly</span>
                                </div>
                                <div class="h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 bg-amber-500 rounded-full" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Recent Activity</h3>
                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-900 text-xs">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Order placed</p>
                                    <p class="text-xs text-slate-500">Today, 09:45 AM • £4,250</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 text-xs">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Call completed</p>
                                    <p class="text-xs text-slate-500">Mar 28, 2026 • 15 minutes</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center text-amber-700 text-xs">
                                    <i class="fas fa-exclamation"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Payment reminder sent</p>
                                    <p class="text-xs text-slate-500">Mar 25, 2026</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Column: Order History -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Trend Chart -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-slate-900">Order Trend (Last 6 Months)</h3>
                            <select class="text-sm border border-slate-200 rounded-lg px-3 py-1">
                                <option>Last 6 Months</option>
                                <option>Last 12 Months</option>
                                <option>This Year</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="orderTrendChart"></canvas>
                        </div>
                    </div>

                    <!-- Order History Timeline -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-semibold text-slate-900">Order History</h3>
                            <a href="sales_orders.html?customer=CLB-001" class="text-sm text-blue-900 hover:underline">View All Orders</a>
                        </div>

                        <div class="space-y-0">
                            <!-- Order 1 -->
                            <div class="order-timeline-item completed">
                                <div class="bg-slate-50 rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-semibold text-slate-900">Order #SO-2026-0892</span>
                                                <span class="px-2 py-0.5 bg-amber-100 text-amber-700 rounded text-xs">Pending</span>
                                            </div>
                                            <p class="text-sm text-slate-500 mb-2">12 items • Coca-Cola, Red Bull, Heinz Ketchup...</p>
                                            <div class="flex items-center gap-4 text-xs text-slate-400">
                                                <span><i class="fas fa-calendar mr-1"></i>Apr 1, 2026</span>
                                                <span><i class="fas fa-truck mr-1"></i>Est. Delivery: Apr 3</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-slate-900">£4,250.00</p>
                                            <button onclick="viewOrder('SO-2026-0892')" class="text-sm text-blue-900 hover:underline mt-1">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order 2 -->
                            <div class="order-timeline-item cancelled">
                                <div class="bg-red-50 rounded-lg p-4 border border-red-100">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-semibold text-slate-900">Order #SO-2026-0887</span>
                                                <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded text-xs">Cancelled</span>
                                            </div>
                                            <p class="text-sm text-slate-500 mb-2">6 items • Reason: Customer request</p>
                                            <div class="flex items-center gap-4 text-xs text-slate-400">
                                                <span><i class="fas fa-calendar mr-1"></i>Mar 25, 2026</span>
                                                <span class="text-red-600"><i class="fas fa-info-circle mr-1"></i>Cancelled Mar 26</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-slate-900 line-through text-slate-400">£3,800.00</p>
                                            <button onclick="viewOrder('SO-2026-0887')" class="text-sm text-blue-900 hover:underline mt-1">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order 3 -->
                            <div class="order-timeline-item completed">
                                <div class="bg-slate-50 rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-semibold text-slate-900">Order #SO-2026-0875</span>
                                                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded text-xs">Delivered</span>
                                            </div>
                                            <p class="text-sm text-slate-500 mb-2">15 items • Coca-Cola, Fanta, Sprite...</p>
                                            <div class="flex items-center gap-4 text-xs text-slate-400">
                                                <span><i class="fas fa-calendar mr-1"></i>Mar 18, 2026</span>
                                                <span><i class="fas fa-check-circle mr-1"></i>Delivered Mar 20</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-slate-900">£8,900.00</p>
                                            <button onclick="viewOrder('SO-2026-0875')" class="text-sm text-blue-900 hover:underline mt-1">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order 4 -->
                            <div class="order-timeline-item completed">
                                <div class="bg-slate-50 rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-semibold text-slate-900">Order #SO-2026-0862</span>
                                                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded text-xs">Delivered</span>
                                            </div>
                                            <p class="text-sm text-slate-500 mb-2">20 items • Full beverage restock</p>
                                            <div class="flex items-center gap-4 text-xs text-slate-400">
                                                <span><i class="fas fa-calendar mr-1"></i>Mar 11, 2026</span>
                                                <span><i class="fas fa-check-circle mr-1"></i>Delivered Mar 13</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-slate-900">£9,200.00</p>
                                            <button onclick="viewOrder('SO-2026-0862')" class="text-sm text-blue-900 hover:underline mt-1">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order 5 -->
                            <div class="order-timeline-item completed">
                                <div class="bg-slate-50 rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-semibold text-slate-900">Order #SO-2026-0848</span>
                                                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded text-xs">Delivered</span>
                                            </div>
                                            <p class="text-sm text-slate-500 mb-2">18 items • Standard weekly order</p>
                                            <div class="flex items-center gap-4 text-xs text-slate-400">
                                                <span><i class="fas fa-calendar mr-1"></i>Mar 4, 2026</span>
                                                <span><i class="fas fa-check-circle mr-1"></i>Delivered Mar 6</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-slate-900">£8,750.00</p>
                                            <button onclick="viewOrder('SO-2026-0848')" class="text-sm text-blue-900 hover:underline mt-1">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Table -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Monthly Comparison</h3>
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-slate-500 border-b border-slate-200">
                                    <th class="pb-3">Month</th>
                                    <th class="pb-3 text-right">Orders</th>
                                    <th class="pb-3 text-right">Revenue</th>
                                    <th class="pb-3 text-right">Avg Order</th>
                                    <th class="pb-3 text-center">Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3">April 2026 (MTD)</td>
                                    <td class="py-3 text-right">1</td>
                                    <td class="py-3 text-right font-medium text-red-600">£4,250</td>
                                    <td class="py-3 text-right">£4,250</td>
                                    <td class="py-3 text-center"><i class="fas fa-arrow-down text-red-500"></i></td>
                                </tr>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3">March 2026</td>
                                    <td class="py-3 text-right">4</td>
                                    <td class="py-3 text-right">£30,650</td>
                                    <td class="py-3 text-right">£7,663</td>
                                    <td class="py-3 text-center"><i class="fas fa-arrow-down text-red-500"></i></td>
                                </tr>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3">February 2026</td>
                                    <td class="py-3 text-right">5</td>
                                    <td class="py-3 text-right">£42,100</td>
                                    <td class="py-3 text-right">£8,420</td>
                                    <td class="py-3 text-center"><i class="fas fa-arrow-up text-emerald-500"></i></td>
                                </tr>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3">January 2026</td>
                                    <td class="py-3 text-right">4</td>
                                    <td class="py-3 text-right">£35,200</td>
                                    <td class="py-3 text-right">£8,800</td>
                                    <td class="py-3 text-center"><i class="fas fa-minus text-slate-400"></i></td>
                                </tr>
                                <tr class="bg-slate-50 font-semibold">
                                    <td class="py-3">3-Month Average</td>
                                    <td class="py-3 text-right">4.3</td>
                                    <td class="py-3 text-right">£35,983</td>
                                    <td class="py-3 text-right">£8,628</td>
                                    <td class="py-3 text-center">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
    const sections = ['section-main', 'section-analytics', 'section-tools'];
    sections.forEach(sectionId => {
        const isSectionCollapsed = localStorage.getItem(sectionId + '_collapsed') === 'true';
        if (isSectionCollapsed) {
            document.getElementById(sectionId).classList.add('collapsed');
        }
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
        window.location.href = 'index.html';
    }
}

        // Chart.js - Order Trend
        const ctx = document.getElementById('orderTrendChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr (MTD)'],
                datasets: [{
                    label: 'Monthly Revenue',
                    data: [38900, 42100, 35200, 42100, 30650, 4250],
                    backgroundColor: [
                        '#1e40af',
                        '#1e40af',
                        '#1e40af',
                        '#1e40af',
                        '#dc2626',
                        '#dc2626'
                    ],
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '£' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>