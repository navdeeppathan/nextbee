<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returns Processing | NextBee B2B</title>
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

        .return-card {
            background: white;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .return-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #cbd5e1;
        }
        .return-pending { border-left: 4px solid #f59e0b; }
        .return-approved { border-left: 4px solid #10b981; }
        .return-rejected { border-left: 4px solid #ef4444; }
        .return-processing { border-left: 4px solid #3b82f6; }

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
                    <a href="/inventory/dashboard" class="nav-item">
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
                    <a href="/returns" class="nav-item active">
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
                    {{-- <a href="/sales-dashboard" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
                        <span class="nav-text">Sales Dashboard</span>
                        <span class="tooltip">Sales Dashboard</span>
                    </a> --}}
                    <a href="/sales-orders-inventory" class="nav-item">
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
            <button 
            class="logout-btn" 
            type="submit"
            {{-- onclick="logout()"  --}}
            aria-label="Logout">
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
                        <h1 class="font-display text-2xl font-bold text-slate-900">Returns Processing</h1>
                        <p class="text-sm text-slate-500">Manage returns, refunds & quality issues</p>
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
            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                <div class="glass rounded-2xl p-4 border border-slate-200 text-center">
                    <p class="text-2xl font-bold text-slate-900 font-display">24</p>
                    <p class="text-xs text-slate-500 uppercase mt-1">Pending Review</p>
                </div>
                <div class="glass rounded-2xl p-4 border border-slate-200 text-center">
                    <p class="text-2xl font-bold text-blue-600 font-display">8</p>
                    <p class="text-xs text-slate-500 uppercase mt-1">Processing</p>
                </div>
                <div class="glass rounded-2xl p-4 border border-slate-200 text-center">
                    <p class="text-2xl font-bold text-emerald-600 font-display">156</p>
                    <p class="text-xs text-slate-500 uppercase mt-1">Approved (MTD)</p>
                </div>
                <div class="glass rounded-2xl p-4 border border-slate-200 text-center">
                    <p class="text-2xl font-bold text-red-600 font-display">12</p>
                    <p class="text-xs text-slate-500 uppercase mt-1">Rejected (MTD)</p>
                </div>
                <div class="glass rounded-2xl p-4 border border-slate-200 text-center">
                    <p class="text-2xl font-bold text-amber-600 font-display">£4,250</p>
                    <p class="text-xs text-slate-500 uppercase mt-1">Value at Risk</p>
                </div>
            </div>

            <!-- Returns List -->
            <div class="space-y-4">

                <!-- Return 1: Pending Approval -->
                <div class="return-card rounded-2xl p-6 return-pending">
                    <div class="flex flex-col lg:flex-row gap-6 justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded uppercase">Pending Approval</span>
                                <span class="text-xs text-slate-500">RET-2026-0401-001</span>
                                <span class="text-xs text-slate-500">Submitted: Today 09:30 AM</span>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4 mb-4">
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <p class="text-xs text-slate-500 uppercase mb-2">Customer</p>
                                    <p class="font-bold text-slate-900">Tesco Express Camden</p>
                                    <p class="text-sm text-slate-500">CUST-001 • Ahmed Hassan</p>
                                </div>
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <p class="text-xs text-slate-500 uppercase mb-2">Original Delivery</p>
                                    <p class="font-bold text-slate-900">Route A-04 • Yesterday</p>
                                    <p class="text-sm text-slate-500">Driver: John Davies</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <p class="text-xs font-bold text-slate-500 uppercase">Returned Items</p>

                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <div class="flex items-center gap-4">
                                        <span class="text-2xl">🥛</span>
                                        <div>
                                            <p class="font-semibold text-slate-900">Fresh Whole Milk 2L</p>
                                            <p class="text-xs text-slate-500">SKU: MILK-2L-FW • Lot: M240331-A</p>
                                            <p class="text-xs text-amber-600">Reason: Short expiry (1 day remaining)</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-slate-900">12 units</p>
                                        <p class="text-xs text-slate-500">£24.00 value</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <div class="flex items-center gap-4">
                                        <span class="text-2xl">🥚</span>
                                        <div>
                                            <p class="font-semibold text-slate-900">Free-Range Eggs (12pk)</p>
                                            <p class="text-xs text-slate-500">SKU: EGG-12-LRG • Lot: E240325-B</p>
                                            <p class="text-xs text-amber-600">Reason: 3 cartons damaged</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-slate-900">3 cartons</p>
                                        <p class="text-xs text-slate-500">£9.00 value</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <p class="text-xs text-slate-500 uppercase mb-1">Customer Notes</p>
                                <p class="text-sm text-slate-700">"The milk delivered yesterday expires tomorrow. Our customers expect minimum 5 days shelf life. Also 3 egg cartons were crushed during transport."</p>
                            </div>
                        </div>

                        <div class="lg:w-80 space-y-4">
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <p class="text-xs font-bold text-slate-500 uppercase mb-3">Return Summary</p>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Items Total</span>
                                        <span class="text-slate-900 font-bold">£33.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Restocking Fee</span>
                                        <span class="text-slate-900">£0.00</span>
                                    </div>
                                    <div class="border-t border-slate-200 pt-2 flex justify-between">
                                        <span class="text-slate-500">Refund Amount</span>
                                        <span class="text-amber-600 font-bold">£33.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl">
                                <p class="text-xs text-amber-600 font-bold uppercase mb-2">System Analysis</p>
                                <p class="text-xs text-slate-600">Lot M240331-A was indeed short-dated. Driver report confirms 3 damaged egg cartons. Recommend: Full approval.</p>
                            </div>

                            <div class="space-y-2">
                                <button class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 rounded-lg text-white font-semibold transition flex items-center justify-center gap-2">
                                    <i class="fas fa-check"></i> Approve Return
                                </button>
                                <button class="w-full py-3 bg-red-50 text-red-600 border border-red-200 rounded-lg font-semibold transition hover:bg-red-100">
                                    Reject & Escalate
                                </button>
                                <button class="w-full py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg text-sm font-semibold transition">
                                    Request More Info
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Return 2: Processing -->
                <div class="return-card rounded-2xl p-6 return-processing">
                    <div class="flex flex-col lg:flex-row gap-6 justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded uppercase">Processing</span>
                                <span class="text-xs text-slate-500">RET-2026-0331-089</span>
                                <span class="text-xs text-slate-500">Approved: Yesterday 2:15 PM</span>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4 mb-4">
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <p class="text-xs text-slate-500 uppercase mb-2">Customer</p>
                                    <p class="font-bold text-slate-900">Sainsbury's Local Islington</p>
                                    <p class="text-sm text-slate-500">CUST-002 • Sarah Johnson</p>
                                </div>
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <p class="text-xs text-slate-500 uppercase mb-2">Collection Scheduled</p>
                                    <p class="font-bold text-blue-600">Today • Route B-12</p>
                                    <p class="text-sm text-slate-500">Driver: Sarah Miller</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <p class="text-xs font-bold text-slate-500 uppercase">Items to Collect</p>

                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <div class="flex items-center gap-4">
                                        <span class="text-2xl">🧀</span>
                                        <div>
                                            <p class="font-semibold text-slate-900">Cheddar Cheese Block 500g</p>
                                            <p class="text-xs text-slate-500">SKU: CHEESE-CHD-500 • Lot: C240320-A</p>
                                            <p class="text-xs text-blue-600">Status: Awaiting collection</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-slate-900">8 blocks</p>
                                        <p class="text-xs text-slate-500">£32.00 value</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 flex items-center gap-4 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 animate-pulse">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-blue-600">Collection in Progress</p>
                                    <p class="text-xs text-slate-500">Driver Sarah Miller estimated arrival: 11:30 AM</p>
                                </div>
                            </div>
                        </div>

                        <div class="lg:w-80 space-y-4">
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <p class="text-xs font-bold text-slate-500 uppercase mb-3">Refund Status</p>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <span class="text-slate-500">Credit note issued</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <span class="text-slate-500">Account credited</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                                        <span class="text-blue-600">Physical collection pending</span>
                                    </div>
                                </div>
                                <div class="mt-3 pt-3 border-t border-slate-200">
                                    <p class="text-xs text-slate-500">Credit applied to account CUST-002</p>
                                    <p class="text-lg font-bold text-emerald-600">£32.00</p>
                                </div>
                            </div>

                            <button class="w-full py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg text-sm font-semibold transition">
                                Track Collection
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Return 3: Approved & Completed -->
                <div class="return-card rounded-2xl p-6 return-approved">
                    <div class="flex flex-col lg:flex-row gap-6 justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded uppercase">Completed</span>
                                <span class="text-xs text-slate-500">RET-2026-0328-156</span>
                                <span class="text-xs text-slate-500">Resolved: 3 days ago</span>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4 mb-4">
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <p class="text-xs text-slate-500 uppercase mb-2">Customer</p>
                                    <p class="font-bold text-slate-900">Costcutter Hackney</p>
                                    <p class="text-sm text-slate-500">CUST-089 • Raj Patel</p>
                                </div>
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <p class="text-xs text-slate-500 uppercase mb-2">Resolution</p>
                                    <p class="font-bold text-emerald-600">Collected & Refunded</p>
                                    <p class="text-sm text-slate-500">Driver: Robert King • 30/03</p>
                                </div>
                            </div>

                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <span class="text-2xl">🍞</span>
                                        <div>
                                            <p class="font-semibold text-slate-900">Sliced White Bread</p>
                                            <p class="text-xs text-slate-500">SKU: BREAD-WHT-SLC • Lot: B240325-X</p>
                                            <p class="text-xs text-emerald-600">Reason: Mold detected • Resolved</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-slate-400">24 loaves</p>
                                        <p class="text-xs text-slate-400 line-through">£28.80</p>
                                        <p class="text-xs text-emerald-600">Refunded</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                                <p class="text-xs text-emerald-600 font-bold uppercase mb-1">Quality Control Note</p>
                                <p class="text-xs text-slate-600">Lot B240325-X removed from inventory. Supplier notification sent. Root cause: Storage temperature excursion during transport.</p>
                            </div>
                        </div>

                        <div class="lg:w-80 space-y-4">
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <p class="text-xs font-bold text-slate-500 uppercase mb-3">Final Summary</p>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Refund Issued</span>
                                        <span class="text-emerald-600 font-bold">£28.80</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Items Collected</span>
                                        <span class="text-slate-900">24 loaves</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Disposal Method</span>
                                        <span class="text-slate-900">Waste (Quality)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <button class="flex-1 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg text-sm font-semibold transition">View Details</button>
                                <button class="flex-1 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-semibold transition">Print Report</button>
                            </div>
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