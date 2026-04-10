<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details | Sales Rep Portal</title>
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
                            <div class="flex items-center gap-2">
                                <h1 class="font-display text-2xl font-bold text-slate-900">Order #SO-2026-0892</h1>
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-sm font-medium">Pending</span>
                            </div>
                            <p class="text-sm text-slate-500">Placed on Apr 1, 2026 at 09:45 AM</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="editOrder()" class="px-4 py-2 border border-slate-200 rounded-lg hover:bg-slate-50 transition">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </button>
                    <button onclick="cancelOrder()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                </div>
            </div>
        </header>

        <div class="p-6">
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Left Column: Order Info -->
                <div class="space-y-6">
                    <!-- Customer Info -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Customer Information</h3>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-900 font-bold">
                                LB
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">London Bistro Ltd</p>
                                <p class="text-sm text-slate-500">ID: CLB-001 • Gold Tier</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
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
                        <button onclick="viewCustomer()" class="w-full mt-4 py-2 text-blue-900 border border-blue-200 rounded-lg hover:bg-blue-50 transition text-sm">
                            View Customer Profile
                        </button>
                    </div>

                    <!-- Order Summary -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Order Summary</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Subtotal</span>
                                <span class="font-medium">£3,541.67</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">VAT (20%)</span>
                                <span class="font-medium">£708.33</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Delivery</span>
                                <span class="font-medium text-emerald-600">Free</span>
                            </div>
                            <div class="border-t border-slate-200 pt-3 flex justify-between">
                                <span class="font-semibold">Total</span>
                                <span class="font-bold text-xl text-slate-900">£4,250.00</span>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-slate-50 rounded-lg">
                            <p class="text-sm text-slate-500">Payment Terms</p>
                            <p class="font-semibold">Net 30 days</p>
                        </div>
                    </div>

                    <!-- Delivery Info -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Delivery Information</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-start gap-2">
                                <i class="fas fa-truck text-slate-400 mt-0.5"></i>
                                <div>
                                    <p class="font-medium">Next-Day Delivery</p>
                                    <p class="text-slate-500">Est. Delivery: Apr 3, 2026</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-2">
                                <i class="fas fa-map-marker-alt text-slate-400 mt-0.5"></i>
                                <div>
                                    <p class="font-medium">Delivery Address</p>
                                    <p class="text-slate-500">45 High Street, London W1B 1EG</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-2">
                                <i class="fas fa-clock text-slate-400 mt-0.5"></i>
                                <div>
                                    <p class="font-medium">Delivery Instructions</p>
                                    <p class="text-slate-500">Deliver to rear entrance. Call 30 mins before arrival.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Column: Order Items -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Items -->
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                        <div class="p-6 border-b border-slate-200">
                            <h3 class="font-semibold text-slate-900">Order Items (12)</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-slate-50">
                                    <tr class="text-left text-slate-500">
                                        <th class="p-4">Product</th>
                                        <th class="p-4 text-right">SKU</th>
                                        <th class="p-4 text-right">Qty</th>
                                        <th class="p-4 text-right">Unit Price</th>
                                        <th class="p-4 text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Coca Cola 330ml Cans (24 pack)</p>
                                            <p class="text-xs text-slate-500">Beverages</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">CC-330-24</td>
                                        <td class="p-4 text-right">10 cases</td>
                                        <td class="p-4 text-right">£8.45</td>
                                        <td class="p-4 text-right font-medium">£84.50</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Red Bull Energy Drink 250ml (24 pack)</p>
                                            <p class="text-xs text-slate-500">Beverages</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">RB-250-24</td>
                                        <td class="p-4 text-right">5 cases</td>
                                        <td class="p-4 text-right">£18.90</td>
                                        <td class="p-4 text-right font-medium">£94.50</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Evian Natural Water 500ml (24 pack)</p>
                                            <p class="text-xs text-slate-500">Beverages</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">EV-500-24</td>
                                        <td class="p-4 text-right">8 cases</td>
                                        <td class="p-4 text-right">£12.30</td>
                                        <td class="p-4 text-right font-medium">£98.40</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Heinz Baked Beans 415g (24 pack)</p>
                                            <p class="text-xs text-slate-500">Food & Groceries</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">HB-415-24</td>
                                        <td class="p-4 text-right">6 cases</td>
                                        <td class="p-4 text-right">£14.40</td>
                                        <td class="p-4 text-right font-medium">£86.40</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Heinz Tomato Ketchup 5L (2 pack)</p>
                                            <p class="text-xs text-slate-500">Food & Groceries</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">HK-5L-2</td>
                                        <td class="p-4 text-right">4 cases</td>
                                        <td class="p-4 text-right">£16.80</td>
                                        <td class="p-4 text-right font-medium">£67.20</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Barilla Spaghetti No.5 500g (20 pack)</p>
                                            <p class="text-xs text-slate-500">Food & Groceries</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">BA-PASTA-500</td>
                                        <td class="p-4 text-right">3 cases</td>
                                        <td class="p-4 text-right">£18.00</td>
                                        <td class="p-4 text-right font-medium">£54.00</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Filippo Berio Olive Oil 5L (4 pack)</p>
                                            <p class="text-xs text-slate-500">Food & Groceries</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">FB-OIL-5L</td>
                                        <td class="p-4 text-right">2 cases</td>
                                        <td class="p-4 text-right">£42.00</td>
                                        <td class="p-4 text-right font-medium">£84.00</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Uncle Ben's Long Grain Rice 5kg</p>
                                            <p class="text-xs text-slate-500">Food & Groceries</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">UB-RICE-5K</td>
                                        <td class="p-4 text-right">4 cases</td>
                                        <td class="p-4 text-right">£28.50</td>
                                        <td class="p-4 text-right font-medium">£114.00</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Birds Eye Garden Peas 1kg (10 pack)</p>
                                            <p class="text-xs text-slate-500">Frozen Foods</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">BE-PEAS-1K</td>
                                        <td class="p-4 text-right">3 cases</td>
                                        <td class="p-4 text-right">£22.00</td>
                                        <td class="p-4 text-right font-medium">£66.00</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">McCain Oven Chips 2.5kg (4 pack)</p>
                                            <p class="text-xs text-slate-500">Frozen Foods</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">MC-CHIPS-2.5K</td>
                                        <td class="p-4 text-right">5 cases</td>
                                        <td class="p-4 text-right">£19.20</td>
                                        <td class="p-4 text-right font-medium">£96.00</td>
                                    </tr>
                                    <tr class="border-b border-slate-100">
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Wall's Magnum Classic 110ml (20 pack)</p>
                                            <p class="text-xs text-slate-500">Frozen Foods</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">WM-MAG-110</td>
                                        <td class="p-4 text-right">4 cases</td>
                                        <td class="p-4 text-right">£18.40</td>
                                        <td class="p-4 text-right font-medium">£73.60</td>
                                    </tr>
                                    <tr>
                                        <td class="p-4">
                                            <p class="font-medium text-slate-900">Chicago Town Pizza 4 Pack (12 pack)</p>
                                            <p class="text-xs text-slate-500">Frozen Foods</p>
                                        </td>
                                        <td class="p-4 text-right text-slate-500">CT-PIZZA-4</td>
                                        <td class="p-4 text-right">3 cases</td>
                                        <td class="p-4 text-right">£24.00</td>
                                        <td class="p-4 text-right font-medium">£72.00</td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-slate-50 font-semibold">
                                    <tr>
                                        <td class="p-4" colspan="4">Total</td>
                                        <td class="p-4 text-right">£4,250.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Order Timeline -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Order Timeline</h3>
                        <div class="space-y-0">
                            <div class="timeline-item">
                                <p class="font-medium text-slate-900">Order Placed</p>
                                <p class="text-sm text-slate-500">Apr 1, 2026 at 09:45 AM</p>
                                <p class="text-sm text-slate-500">By: James Wilson (Customer)</p>
                            </div>
                            <div class="timeline-item">
                                <p class="font-medium text-slate-900">Payment Terms Approved</p>
                                <p class="text-sm text-slate-500">Apr 1, 2026 at 09:47 AM</p>
                                <p class="text-sm text-slate-500">Net 30 terms automatically applied</p>
                            </div>
                            <div class="timeline-item pending">
                                <p class="font-medium text-slate-900">Awaiting Confirmation</p>
                                <p class="text-sm text-slate-500">Current Status</p>
                                <p class="text-sm text-amber-600">Order pending sales review</p>
                            </div>
                            <div class="timeline-item opacity-50">
                                <p class="font-medium text-slate-400">Order Confirmed</p>
                                <p class="text-sm text-slate-400">Pending</p>
                            </div>
                            <div class="timeline-item opacity-50">
                                <p class="font-medium text-slate-400">Processing</p>
                                <p class="text-sm text-slate-400">Pending</p>
                            </div>
                            <div class="timeline-item opacity-50">
                                <p class="font-medium text-slate-400">Shipped</p>
                                <p class="text-sm text-slate-400">Pending</p>
                            </div>
                            <div class="timeline-item opacity-50">
                                <p class="font-medium text-slate-400">Delivered</p>
                                <p class="text-sm text-slate-400">Pending</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notes & Communication -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Notes & Communication</h3>
                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-900 text-xs">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-medium text-sm">James Wilson</span>
                                        <span class="text-xs text-slate-500">Apr 1, 09:45 AM</span>
                                    </div>
                                    <p class="text-sm text-slate-600">Please ensure all frozen items are delivered before 10 AM to maintain quality. Thanks!</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <input type="text" placeholder="Add a note..." class="flex-1 px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-blue-900">
                            <button class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition text-sm">
                                Add Note
                            </button>
                        </div>
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
    </script>
</body>
</html>