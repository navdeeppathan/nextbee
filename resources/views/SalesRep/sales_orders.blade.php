<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders | Sales Rep Portal</title>
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

            .order-row {
                display: grid;
                grid-template-columns: 1.5fr 2fr 1fr 1fr 1fr 1fr 120px;
                gap: 16px;
                align-items: center;
                padding: 16px 20px;
                background: white;
                border-bottom: 1px solid #e2e8f0;
                transition: background 0.2s;
            }

            .order-row:hover {
                background: #f8fafc;
            }

            .status-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
            }

            .status-pending {
                background: #fffbeb;
                color: #b45309;
            }

            .status-confirmed {
                background: #f0fdf4;
                color: #15803d;
            }

            .status-processing {
                background: #eff6ff;
                color: #1d4ed8;
            }

            .status-delivered {
                background: #f0fdf4;
                color: #15803d;
            }

            .status-cancelled {
                background: #fef2f2;
                color: #dc2626;
            }

            @media (max-width: 1024px) {
                .sidebar {
                    transform: translateX(-100%);
                }
                .sidebar.active {
                    transform: translateX(0);
                }
                .main-content {
                    margin-left: 0;
                }
                .order-row {
                    grid-template-columns: 1fr;
                    gap: 8px;
                }
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
                    <div>
                        <h1 class="font-display text-2xl font-bold text-slate-900">All Orders</h1>
                        <p class="text-sm text-slate-500">Manage and track all customer orders</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="createOrder()" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">Create Order</span>
                    </button>
                    <button class="relative p-2 text-slate-600 hover:text-blue-900 transition">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">8</span>
                    </button>
                </div>
            </div>
        </header>

        <div class="p-6">
            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 border border-slate-200">
                    <p class="text-sm text-slate-500">Total Orders</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $totalOrders }}</p>
                    <p class="text-xs text-slate-400 mt-1">This month</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-200">
                    <p class="text-sm text-slate-500">Pending</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $pendingOrders }}</p>
                    <p class="text-xs text-slate-400 mt-1">Needs action</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-200">
                    <p class="text-sm text-slate-500">Confirmed</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $confirmedOrders }}</p>
                    <p class="text-xs text-slate-400 mt-1">Ready to process</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-200">
                    <p class="text-sm text-slate-500">Processing</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $processingOrders }}</p>
                    <p class="text-xs text-slate-400 mt-1">In fulfillment</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-200">
                    <p class="text-sm text-slate-500">Delivered</p>
                    <p class="text-2xl font-bold text-emerald-600">{{ $deliveredOrders }}</p>
                    <p class="text-xs text-slate-400 mt-1">Completed</p>
                </div>
            </div>

            <!-- Filters -->
            {{-- <div class="bg-white rounded-xl p-4 mb-6 border border-slate-200">
                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex items-center gap-2">
                        <input type="text" placeholder="Search orders..." class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-blue-900 w-64">
                        <button class="p-2 text-slate-600 hover:text-blue-900 bg-slate-100 rounded-lg">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="h-8 w-px bg-slate-200 mx-2"></div>
                    <select class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-blue-900">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Confirmed</option>
                        <option>Processing</option>
                        <option>Delivered</option>
                        <option>Cancelled</option>
                    </select>
                    <select class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-blue-900">
                        <option>All Customers</option>
                        <option>London Bistro Ltd</option>
                        <option>West End Catering</option>
                        <option>Riverside Restaurant</option>
                    </select>
                    <select class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-blue-900">
                        <option>Date Range</option>
                        <option>Today</option>
                        <option>Last 7 Days</option>
                        <option>Last 30 Days</option>
                        <option>This Month</option>
                        <option>Last Month</option>
                    </select>
                    <button class="ml-auto px-4 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50 flex items-center gap-2">
                        <i class="fas fa-download"></i>
                        Export
                    </button>
                </div>
            </div> --}}

            <!-- Orders Table -->
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <div class="min-w-[1000px]">
                        <!-- Header -->
                        <div class="order-row bg-slate-50 font-semibold text-xs uppercase tracking-wider text-slate-500 border-b-2 border-slate-200">
                            <div>Order ID</div>
                            <div>Customer</div>
                            <div>Date</div>
                            <div>Amount</div>
                            <div>Status</div>
                            <div>Payment</div>
                            <div>Action</div>
                        </div>

                         @foreach($orders as $order)
                        <div class="order-row">
                            <div>
                                <p class="font-semibold text-blue-900">#SO-{{ $order->id }}</p>
                                <p class="text-xs text-slate-500">
                                    {{ $order->items->count() }} items
                                </p>
                            </div>

                            <div>
                                <p class="font-medium text-slate-900">
                                    {{ $order->user->name ?? 'N/A' }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    ID: {{ $order->user->id ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-900">
                                    {{ $order->created_at->format('M d, Y') }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ $order->created_at->format('h:i A') }}
                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-slate-900">
                                    £{{ number_format($order->total_price, 2) }}
                                </p>
                            </div>

                            <div>
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-slate-600">
                                    {{ $order->payment->status ?? 'No Payment' }}
                                </p>
                            </div>

                            <div>
                                <button class="text-blue-900 hover:underline text-sm">
                                    <a href="/checkout-sales/{{ $order->id }}">View</a>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        <!-- Order 1 -->
                        {{-- <div class="order-row">
                            <div>
                                <p class="font-semibold text-blue-900">#SO-2026-0892</p>
                                <p class="text-xs text-slate-500">12 items</p>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">London Bistro Ltd</p>
                                <p class="text-xs text-slate-500">ID: CLB-001</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-900">Apr 1, 2026</p>
                                <p class="text-xs text-slate-500">09:45 AM</p>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">£4,250.00</p>
                                <p class="text-xs text-slate-500">Net 30</p>
                            </div>
                            <div>
                                <span class="status-badge status-pending">
                                    <i class="fas fa-clock"></i>
                                    Pending
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600">Awaiting Approval</p>
                            </div>
                            <div>
                                <button onclick="viewOrder('SO-2026-0892')" class="text-blue-900 hover:underline text-sm">View</button>
                            </div>
                        </div> --}}

                        <!-- Order 2 -->
                        {{-- <div class="order-row">
                            <div>
                                <p class="font-semibold text-blue-900">#SO-2026-0891</p>
                                <p class="text-xs text-slate-500">28 items</p>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">West End Catering</p>
                                <p class="text-xs text-slate-500">ID: CWE-002</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-900">Mar 31, 2026</p>
                                <p class="text-xs text-slate-500">04:30 PM</p>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">£9,400.00</p>
                                <p class="text-xs text-slate-500">Net 30</p>
                            </div>
                            <div>
                                <span class="status-badge status-confirmed">
                                    <i class="fas fa-check-circle"></i>
                                    Confirmed
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-600">Approved</p>
                            </div>
                            <div>
                                <button onclick="viewOrder('SO-2026-0891')" class="text-blue-900 hover:underline text-sm">View</button>
                            </div>
                        </div> --}}

                        <!-- Order 3 -->
                        {{-- <div class="order-row">
                            <div>
                                <p class="font-semibold text-blue-900">#SO-2026-0890</p>
                                <p class="text-xs text-slate-500">8 items</p>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">The Crown Pub</p>
                                <p class="text-xs text-slate-500">ID: CTC-004</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-900">Mar 30, 2026</p>
                                <p class="text-xs text-slate-500">11:20 AM</p>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">£2,850.00</p>
                                <p class="text-xs text-slate-500">Net 15</p>
                            </div>
                            <div>
                                <span class="status-badge status-processing">
                                    <i class="fas fa-cog fa-spin"></i>
                                    Processing
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-blue-600">Picking Items</p>
                            </div>
                            <div>
                                <button onclick="viewOrder('SO-2026-0890')" class="text-blue-900 hover:underline text-sm">View</button>
                            </div>
                        </div> --}}

                        <!-- Order 4 -->
                        {{-- <div class="order-row">
                            <div>
                                <p class="font-semibold text-blue-900">#SO-2026-0889</p>
                                <p class="text-xs text-slate-500">18 items</p>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Riverside Restaurant</p>
                                <p class="text-xs text-slate-500">ID: CRR-003</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-900">Mar 28, 2026</p>
                                <p class="text-xs text-slate-500">02:15 PM</p>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">£6,750.00</p>
                                <p class="text-xs text-slate-500">Net 30</p>
                            </div>
                            <div>
                                <span class="status-badge status-delivered">
                                    <i class="fas fa-truck"></i>
                                    Delivered
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-600">Paid</p>
                            </div>
                            <div>
                                <button onclick="viewOrder('SO-2026-0889')" class="text-blue-900 hover:underline text-sm">View</button>
                            </div>
                        </div> --}}

                        <!-- Order 5 -->
                        {{-- <div class="order-row">
                            <div>
                                <p class="font-semibold text-blue-900">#SO-2026-0888</p>
                                <p class="text-xs text-slate-500">45 items</p>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Highbury Gardens Hotel</p>
                                <p class="text-xs text-slate-500">ID: CHG-005</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-900">Mar 27, 2026</p>
                                <p class="text-xs text-slate-500">09:00 AM</p>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">£15,200.00</p>
                                <p class="text-xs text-slate-500">Net 30</p>
                            </div>
                            <div>
                                <span class="status-badge status-delivered">
                                    <i class="fas fa-truck"></i>
                                    Delivered
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-600">Paid</p>
                            </div>
                            <div>
                                <button onclick="viewOrder('SO-2026-0888')" class="text-blue-900 hover:underline text-sm">View</button>
                            </div>
                        </div> --}}

                        <!-- Order 6 -->
                        {{-- <div class="order-row">
                            <div>
                                <p class="font-semibold text-blue-900">#SO-2026-0887</p>
                                <p class="text-xs text-slate-500">6 items</p>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">London Bistro Ltd</p>
                                <p class="text-xs text-slate-500">ID: CLB-001</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-900">Mar 25, 2026</p>
                                <p class="text-xs text-slate-500">03:45 PM</p>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">£3,800.00</p>
                                <p class="text-xs text-slate-500">Net 30</p>
                            </div>
                            <div>
                                <span class="status-badge status-cancelled">
                                    <i class="fas fa-times-circle"></i>
                                    Cancelled
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-red-600">Customer Request</p>
                            </div>
                            <div>
                                <button onclick="viewOrder('SO-2026-0887')" class="text-blue-900 hover:underline text-sm">View</button>
                            </div>
                        </div> --}}

                        <!-- Order 7 -->
                        {{-- <div class="order-row">
                            <div>
                                <p class="font-semibold text-blue-900">#SO-2026-0886</p>
                                <p class="text-xs text-slate-500">22 items</p>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">West End Catering</p>
                                <p class="text-xs text-slate-500">ID: CWE-002</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-900">Mar 22, 2026</p>
                                <p class="text-xs text-slate-500">10:30 AM</p>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">£11,200.00</p>
                                <p class="text-xs text-slate-500">Net 30</p>
                            </div>
                            <div>
                                <span class="status-badge status-delivered">
                                    <i class="fas fa-truck"></i>
                                    Delivered
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-600">Paid</p>
                            </div>
                            <div>
                                <button onclick="viewOrder('SO-2026-0886')" class="text-blue-900 hover:underline text-sm">View</button>
                            </div>
                        </div> --}}

                        <!-- Order 8 -->
                        {{-- <div class="order-row">
                            <div>
                                <p class="font-semibold text-blue-900">#SO-2026-0885</p>
                                <p class="text-xs text-slate-500">15 items</p>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Riverside Restaurant</p>
                                <p class="text-xs text-slate-500">ID: CRR-003</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-900">Mar 20, 2026</p>
                                <p class="text-xs text-slate-500">01:00 PM</p>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">£7,100.00</p>
                                <p class="text-xs text-slate-500">Net 30</p>
                            </div>
                            <div>
                                <span class="status-badge status-delivered">
                                    <i class="fas fa-truck"></i>
                                    Delivered
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-600">Paid</p>
                            </div>
                            <div>
                                <button onclick="viewOrder('SO-2026-0885')" class="text-blue-900 hover:underline text-sm">View</button>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between p-4 border-t border-slate-200">
                    <p class="text-sm text-slate-500">Showing 8 of 156 orders</p>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50 disabled:opacity-50" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-4 py-2 bg-blue-900 text-white rounded-lg text-sm">1</button>
                        <button class="px-4 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">2</button>
                        <button class="px-4 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">3</button>
                        <span class="px-2 text-slate-400">...</span>
                        <button class="px-4 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">20</button>
                        <button class="px-3 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
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