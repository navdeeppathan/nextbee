<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management | NextBee B2B</title>
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

        .expiry-badge { font-size: 0.65rem; padding: 2px 8px; border-radius: 9999px; font-weight: 700; }
        .expiry-critical { background: #ef4444; color: white; }
        .expiry-warning { background: #f59e0b; color: white; }
        .expiry-good { background: #10b981; color: white; }
        .location-pill { background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3); color: #2563eb; }
        .aisle-a { border-left: 3px solid #3b82f6; }
        .aisle-b { border-left: 3px solid #8b5cf6; }
        .aisle-c { border-left: 3px solid #ec4899; }
        .aisle-d { border-left: 3px solid #10b981; }

        .inventory-card {
            background: white;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .inventory-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #cbd5e1;
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
                    <a href="/inventory-page" class="nav-item active">
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
                    <a href="/sales-orders" class="nav-item">
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
            type="submit"
             class="logout-btn"
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
                        <h1 class="font-display text-2xl font-bold text-slate-900">Inventory Management</h1>
                        <p class="text-sm text-slate-500">Stock levels, locations & expiry tracking</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-slate-500" id="current-date"></span>
                    <button class="relative p-2 text-slate-600 hover:text-blue-900 transition" aria-label="Notifications">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">8</span>
                    </button>
                    <button onclick="document.getElementById('add-item-modal').classList.remove('hidden')" 
                            class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg text-sm font-semibold text-white transition flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">Add Item</span>
                    </button>
                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-sm font-bold text-slate-700 border-2 border-white shadow">
                        AD
                    </div>
                </div>
            </div>
        </header>

        <div class="p-6">
            <!-- Filters & Search -->
            <div class="glass rounded-2xl p-6 mb-6 border border-slate-200">
                <div class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center">
                    <div class="flex gap-4 flex-wrap">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Search SKU, name, or location..." 
                                   class="bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 w-64 text-sm text-slate-900 focus:outline-none focus:border-blue-500">
                            <span class="absolute right-3 top-2.5 text-slate-400"><i class="fas fa-search"></i></span>
                        </div>
                        
                            <select id="categoryFilter" class="bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm text-slate-900">
                                <option>All Categories</option>
                                {{-- <option>Dairy & Eggs</option>
                                <option>Fresh Produce</option>
                                <option>Frozen Goods</option>
                                <option>Dry Goods</option>
                                <option>Beverages</option> --}}
                                @foreach($categories as $category)
                                    <option value="{{ strtolower($category->name) }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        


                        <select id="locationFilter" class="bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm text-slate-900">
                            <option>All Locations</option>
                            <option>Aisle A - Cold Storage</option>
                            <option>Aisle B - Dry Goods</option>
                            <option>Aisle C - Frozen</option>
                            <option>Aisle D - Produce</option>
                        </select>
                    </div>
                    {{-- <div class="flex gap-2">
                        <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-semibold border border-red-200 hover:bg-red-100 transition">
                            <i class="fas fa-exclamation-circle mr-1"></i> Expiring Soon (47)
                        </button>
                        <button class="px-4 py-2 bg-amber-50 text-amber-600 rounded-lg text-sm font-semibold border border-amber-200 hover:bg-amber-100 transition">
                            <i class="fas fa-box-open mr-1"></i> Low Stock (18)
                        </button>
                    </div> --}}
                </div>
            </div>

            <!-- Inventory Grid -->
            <div class="grid gap-4" id="inventory-grid">

                <!-- Item 1: Milk with Multiple Locations & Lots -->
                {{-- <div class="inventory-card rounded-2xl p-6 aisle-a">
                    <div class="flex flex-col lg:flex-row gap-6 justify-between">
                        <div class="flex-1">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center text-3xl">🥛</div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-lg font-bold text-slate-900">Fresh Whole Milk 2L</h3>
                                        <span class="text-xs bg-slate-100 px-2 py-1 rounded text-slate-600 border border-slate-200">SKU: MILK-2L-FW</span>
                                    </div>
                                    <p class="text-sm text-slate-500">Dairy & Eggs • Refrigerated • 2L Carton</p>
                                    <div class="flex items-center gap-4 mt-2 text-xs">
                                        <span class="text-slate-500">MOQ: 12 units</span>
                                        <span class="text-slate-500">Avg Monthly: 1,240 units</span>
                                        <span class="text-emerald-600 font-medium">Stock Age: 2 days</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Multiple Locations -->
                            <div class="space-y-3">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Storage Locations & Lot Details</p>

                                <!-- Location 1 -->
                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <span class="location-pill px-3 py-1 rounded-full text-xs font-bold">A-12-R3-B5</span>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">Aisle A, Rack 3, Basket 5</p>
                                            <p class="text-xs text-slate-500">Lot: M240401-A • Received: Today</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">144 units</p>
                                            <span class="expiry-badge expiry-critical">Exp: Today</span>
                                        </div>
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Move</button>
                                    </div>
                                </div>

                                <!-- Location 2 -->
                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <span class="location-pill px-3 py-1 rounded-full text-xs font-bold">A-14-R2-B1</span>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">Aisle A, Rack 2, Basket 1</p>
                                            <p class="text-xs text-slate-500">Lot: M240402-B • Received: Yesterday</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">96 units</p>
                                            <span class="expiry-badge expiry-warning">Exp: Tomorrow</span>
                                        </div>
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Move</button>
                                    </div>
                                </div>

                                <!-- Location 3 -->
                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <span class="location-pill px-3 py-1 rounded-full text-xs font-bold">A-16-R1-B3</span>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">Aisle A, Rack 1, Basket 3</p>
                                            <p class="text-xs text-slate-500">Lot: M240403-C • Received: 2 days ago</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">72 units</p>
                                            <span class="expiry-badge expiry-good">Exp: 3 days</span>
                                        </div>
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Move</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Alert Panel -->
                        <div class="lg:w-64 space-y-3">
                            <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                                <p class="text-xs font-bold text-red-600 uppercase mb-1">Stock Alert</p>
                                <p class="text-sm text-slate-900 font-medium">Current stock (312) below 2-week avg (620)</p>
                                <p class="text-xs text-slate-500 mt-1">Recommend: Emergency reorder</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <p class="text-xs font-bold text-slate-500 uppercase mb-2">Quick Actions</p>
                                <div class="space-y-2">
                                    <button class="w-full py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-sm font-semibold text-white transition">Transfer Stock</button>
                                    <button class="w-full py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg text-sm font-semibold transition">Create Promotion</button>
                                    <button class="w-full py-2 bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-lg text-sm font-semibold transition">Mark for Delivery</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @foreach($products as $product)
                <div 
                        class="inventory-card rounded-2xl p-6 aisle-{{ strtolower($product->aisle ?? 'a') }}"
                        
                        data-name="{{ strtolower($product->title) }}"
                        data-sku="{{ strtolower($product->sku_code) }}"
                        data-category="{{ strtolower($product->category->name ?? '') }}"
                        data-location="{{ strtolower($product->aisle) }}"
                    >

                    <div class="flex flex-col lg:flex-row gap-6 justify-between">
                        
                        <!-- LEFT -->
                        <div class="flex-1">
                            <div class="flex items-start gap-4 mb-4">

                                <!-- Icon -->
                                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center text-3xl">
                                    <img src="{{asset($product->image)}}" alt="" class="w-12 h-12 object-contain">
                                </div>

                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        
                                        <h3 class="text-lg font-bold text-slate-900">
                                            {{ $product->title }}
                                        </h3>

                                        <span class="text-xs bg-slate-100 px-2 py-1 rounded text-slate-600 border border-slate-200">
                                            SKU: {{ $product->sku_code }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-slate-500">
                                        {{ $product->category->name ?? 'N/A' }} • 
                                       {{ $product->brand ?? 'N/A' }}
                                    </p>

                                    <div class="flex items-center gap-4 mt-2 text-xs">
                                        <span class="text-slate-500">MOQ: {{ $product->moq }}</span>
                                        <span class="text-slate-500">Stock: {{ $product->quantity }} units</span>
                                        {{-- <span class="text-emerald-600 font-medium">
                                            Shelf Life: {{ $product->shelf_life }} days
                                        </span> --}}
                                    </div>
                                </div>
                            </div>

                            <!-- LOCATION -->
                            <div class="space-y-3">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                                    Storage Location
                                </p>

                                {{-- <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                                    
                                    <div class="flex items-center gap-3">
                                        <span class="location-pill px-3 py-1 rounded-full text-xs font-bold">
                                            {{ $product->aisle }}-R{{ $product->rack }}-B{{ $product->basket }}
                                        </span>

                                        <div>
                                            <p class="text-sm font-medium text-slate-900">
                                                Aisle {{ $product->aisle }}, Rack {{ $product->rack }}, Basket {{ $product->basket }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                Quantity: {{ $product->quantity }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-sm font-bold text-slate-900">
                                            {{ $product->quantity }} units
                                        </p>

                                        @if($product->quantity < 50)
                                            <span class="expiry-badge expiry-critical">Low Stock</span>
                                        @elseif($product->quantity < 100)
                                            <span class="expiry-badge expiry-warning">Medium</span>
                                        @else
                                            <span class="expiry-badge expiry-good">Good</span>
                                        @endif
                                    </div>
                                </div> --}}
                                @forelse($product->locations as $location)

                                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                                        
                                        <div class="flex items-center gap-3">
                                            
                                            <!-- LOCATION TAG -->
                                            <span class="location-pill px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $location->aisle }}-R{{ $location->rack }}-B{{ $location->basket }}
                                            </span>

                                            <!-- DETAILS -->
                                            <div>
                                                <p class="text-sm font-medium text-slate-900">
                                                    Aisle {{ $location->aisle }}, 
                                                    Rack {{ $location->rack }}, 
                                                    Basket {{ $location->basket }}
                                                </p>

                                                <p class="text-xs text-slate-500">
                                                    Quantity: {{ $location->quantity }}
                                                </p>
                                                <p class="text-xs text-slate-500">
                                                    Expiry: {{ date('M d, Y', strtotime($location->expiry_date)) }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- RIGHT SIDE -->
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">
                                                {{ $location->quantity }} units
                                            </p>

                                            @if($location->quantity < 50)
                                                <span class="expiry-badge expiry-critical">Low Stock</span>
                                            @elseif($location->quantity < 100)
                                                <span class="expiry-badge expiry-warning">Medium</span>
                                            @else
                                                <span class="expiry-badge expiry-good">Good</span>
                                            @endif
                                        </div>
                                    </div>

                                @empty
                                    <p></p>
                                @endforelse
                            </div>
                        </div>

                        <!-- RIGHT PANEL -->
                        <div class="lg:w-64 space-y-3">
                            {{-- <div class="">
                                <button 
                                    onclick="openEditModal(this)"
                                    class="text-blue-600 hover:text-blue-800"
                                    
                                    data-id="{{ $product->id }}"
                                    data-title="{{ $product->title }}"
                                    data-sku="{{ $product->sku_code }}"
                                    data-category="{{ $product->category_id }}"
                                    data-moq="{{ $product->moq }}"
                                    data-shelf="{{ $product->shelf_life }}"
                                    data-aisle="{{ $product->aisle }}"
                                    data-rack="{{ $product->rack }}"
                                    data-basket="{{ $product->basket }}"
                                    data-quantity="{{ $product->quantity }}"
                                    data-price="{{ $product->price }}"
                                    data-description="{{ $product->description }}"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div> --}}

                            <!-- ALERT -->
                            @if($product->quantity < 50)
                            <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                                <p class="text-xs font-bold text-red-600 uppercase mb-1">Stock Alert</p>
                                <p class="text-sm text-slate-900 font-medium">
                                    Low stock available
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    Recommend reorder
                                </p>
                            </div>
                            @endif

                            

                            <!-- ACTIONS -->
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <p class="text-xs font-bold text-slate-500 uppercase mb-2">
                                    Quick Actions
                                </p>

                                <div class="space-y-2">
                                    {{-- <button class="w-full py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold">
                                        Transfer Stock
                                    </button> --}}

                                    <button 
                                    onclick="openEditModal(this)"
                                    data-id="{{ $product->id }}"
                                    data-title="{{ $product->title }}"
                                    data-sku="{{ $product->sku_code }}"
                                    data-category="{{ $product->category_id }}"
                                    data-moq="{{ $product->moq }}"
                                    data-shelf="{{ $product->shelf_life }}"
                                    data-aisle="{{ $product->aisle }}"
                                    data-rack="{{ $product->rack }}"
                                    data-basket="{{ $product->basket }}"
                                    data-quantity="{{ $product->quantity }}"
                                    data-price="{{ $product->price }}"
                                    data-description="{{ $product->description }}"
                                    data-brand="{{ $product->brand }}"

                                    class="w-full py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-semibold">
                                        Edit Product
                                    </button>

                                    <button  onclick="openLocationModal({{ $product->id }})" class="w-full py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-sm font-semibold text-white transition">Add Location</button>


                                    {{-- <button class="w-full py-2 bg-emerald-100 text-emerald-700 border rounded-lg text-sm font-semibold">
                                        Mark Delivered
                                    </button> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Item 2: Eggs with Single Location -->
                {{-- <div class="inventory-card rounded-2xl p-6 aisle-a">
                    <div class="flex flex-col lg:flex-row gap-6 justify-between">
                        <div class="flex-1">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-16 h-16 bg-amber-100 rounded-xl flex items-center justify-center text-3xl">🥚</div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-lg font-bold text-slate-900">Free-Range Eggs Large (12pk)</h3>
                                        <span class="text-xs bg-slate-100 px-2 py-1 rounded text-slate-600 border border-slate-200">SKU: EGG-12-LRG</span>
                                    </div>
                                    <p class="text-sm text-slate-500">Dairy & Eggs • Refrigerated • 12 Pack</p>
                                    <div class="flex items-center gap-4 mt-2 text-xs">
                                        <span class="text-slate-500">MOQ: 20 cartons</span>
                                        <span class="text-slate-500">Avg Monthly: 890 cartons</span>
                                        <span class="text-amber-600 font-medium">Stock Age: 5 days</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Storage Locations</p>
                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <span class="location-pill px-3 py-1 rounded-full text-xs font-bold">A-08-R4-B2</span>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">Aisle A, Rack 4, Basket 2</p>
                                            <p class="text-xs text-slate-500">Lot: E240331-B • Received: 5 days ago</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">180 cartons</p>
                                            <span class="expiry-badge expiry-warning">Exp: Tomorrow</span>
                                        </div>
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Move</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:w-64 space-y-3">
                            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl">
                                <p class="text-xs font-bold text-amber-600 uppercase mb-1">Stock Comparison</p>
                                <p class="text-sm text-slate-900 font-medium">Current (180) vs Avg (890)</p>
                                <div class="mt-2 h-2 bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-amber-500 w-[20%]"></div>
                                </div>
                                <p class="text-xs text-slate-500 mt-1">20% of monthly average</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <div class="space-y-2">
                                    <button class="w-full py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-sm font-semibold text-white transition">Add Location</button>
                                    <button class="w-full py-2 bg-amber-100 text-amber-700 border border-amber-200 rounded-lg text-sm font-semibold transition">Flash Sale</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Item 3: Rice - Dry Goods, Multiple Locations -->
                {{-- <div class="inventory-card rounded-2xl p-6 aisle-b">
                    <div class="flex flex-col lg:flex-row gap-6 justify-between">
                        <div class="flex-1">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center text-3xl">🍚</div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-lg font-bold text-slate-900">Basmati Rice 5kg</h3>
                                        <span class="text-xs bg-slate-100 px-2 py-1 rounded text-slate-600 border border-slate-200">SKU: RICE-BAS-5K</span>
                                    </div>
                                    <p class="text-sm text-slate-500">Dry Goods • Ambient • 5kg Bag</p>
                                    <div class="flex items-center gap-4 mt-2 text-xs">
                                        <span class="text-slate-500">MOQ: 10 bags</span>
                                        <span class="text-slate-500">Avg Monthly: 340 bags</span>
                                        <span class="text-emerald-600 font-medium">Stock Age: 45 days</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Storage Locations</p>

                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <span class="location-pill px-3 py-1 rounded-full text-xs font-bold">B-04-R1-B8</span>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">Aisle B, Rack 1, Basket 8</p>
                                            <p class="text-xs text-slate-500">Lot: R240215-A • Exp: Dec 2026</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">120 bags</p>
                                            <span class="expiry-badge expiry-good">Exp: 20 months</span>
                                        </div>
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Move</button>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <span class="location-pill px-3 py-1 rounded-full text-xs font-bold">B-06-R2-B4</span>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">Aisle B, Rack 2, Basket 4</p>
                                            <p class="text-xs text-slate-500">Lot: R240301-B • Exp: Jan 2027</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-slate-900">85 bags</p>
                                            <span class="expiry-badge expiry-good">Exp: 21 months</span>
                                        </div>
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Move</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:w-64 space-y-3">
                            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                                <p class="text-xs font-bold text-emerald-600 uppercase mb-1">Stock Healthy</p>
                                <p class="text-sm text-slate-900 font-medium">205 bags (60% of monthly avg)</p>
                                <p class="text-xs text-slate-500 mt-1">No action required</p>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </main>

    <!-- Add Item Modal -->
    <div id="add-item-modal" class="hidden fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-slate-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-slate-900 font-display">Add New Inventory Item</h2>
                <button onclick="document.getElementById('add-item-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Item Name</label>
                        <input type="text" name="title" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="e.g., Semi-Skimmed Milk 1L">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">SKU Code</label>
                        <input type="text" name="sku_code" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="e.g., MILK-SSL-1L">
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Category</label>
                        <select name="category_id" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">MOQ (Units)</label>
                        <input type="number" name="moq" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="12">
                    </div>
                    {{-- <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Shelf Life (Days)</label>
                        <input type="number" name="shelf_life" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="7">
                    </div> --}}

                    <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Product Type</label>
                            <select name="product_type" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2">
                                <option value="A - Cold Storage">A - Cold Storage</option>
                                <option value="B - Dry Goods">B - Dry Goods</option>
                                <option value="C - Frozen">C - Frozen</option>
                                <option value="D - Produce">D - Produce</option>
                            </select>
                        </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Product Brand</label>
                    <input type="number" name="brand" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="7">
                </div>

                <div class="border-t border-slate-200 pt-6">
                    {{-- <h3 class="text-sm font-bold text-slate-900 mb-4">Primary Location</h3>
                    <div class="grid md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Aisle</label>
                            <select name="aisle" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2">
                                <option value="A - Cold Storage">A - Cold Storage</option>
                                <option value="B - Dry Goods">B - Dry Goods</option>
                                <option value="C - Frozen">C - Frozen</option>
                                <option value="D - Produce">D - Produce</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Rack</label>
                            <input type="number" name="rack"  class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-slate-900" placeholder="1">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Basket</label>
                            <input type="number"name="basket" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-slate-900" placeholder="1">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Quantity</label>
                            <input type="number" name="quantity" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-slate-900" placeholder="0">
                        </div>
                    </div> --}}
                     <!-- Optional Fields -->
                    <div class="grid md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Price</label>
                            <input type="number" name="price" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Image</label>
                            <input type="file" name="image" class="w-full">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Description</label>
                        <textarea name="description" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3"></textarea>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="document.getElementById('add-item-modal').classList.add('hidden')" class="flex-1 py-3 border border-slate-300 rounded-lg text-slate-600 font-semibold hover:bg-slate-50 transition">Cancel</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 rounded-lg text-white font-semibold hover:bg-blue-500 transition">Add Item</button>
                </div>
            </form>
        </div>
    </div>

    <div id="update-item-modal" class="hidden fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-slate-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-slate-900 font-display">Update Inventory Item</h2>
                <button onclick="document.getElementById('add-item-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
            </div>

            <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Item Name</label>
                        <input type="text" name="title" id="edit_title" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="e.g., Semi-Skimmed Milk 1L">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">SKU Code</label>
                        <input type="text" name="sku_code" id="edit_sku" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="e.g., MILK-SSL-1L">
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Category</label>
                        <select name="category_id" id="edit_category" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">MOQ (Units)</label>
                        <input type="number" name="moq" id="edit_moq" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="12">
                    </div>
                    {{-- <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Shelf Life (Days)</label>
                        <input type="number" name="shelf_life" id="edit_shelf" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="7">
                    </div> --}}
                    <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Product Type</label>
                            <select name="product_type" id="edit_type" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2">
                                <option value="A - Cold Storage">A - Cold Storage</option>
                                <option value="B - Dry Goods">B - Dry Goods</option>
                                <option value="C - Frozen">C - Frozen</option>
                                <option value="D - Produce">D - Produce</option>
                            </select>
                        </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Product Brand</label>
                    <input type="text" name="brand" id="edit_brand" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="e.g., Nestle">
                </div>

                <div class="border-t border-slate-200 pt-6">
                    {{-- <h3 class="text-sm font-bold text-slate-900 mb-4">Primary Location</h3> --}}
                    {{-- <div class="grid md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Aisle</label>
                            <select name="aisle" id="edit_aisle" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2">
                                <option value="A - Cold Storage">A - Cold Storage</option>
                                <option value="B - Dry Goods">B - Dry Goods</option>
                                <option value="C - Frozen">C - Frozen</option>
                                <option value="D - Produce">D - Produce</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Rack</label>
                            <input type="number" name="rack" id="edit_rack"  class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-slate-900" placeholder="1">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Basket</label>
                            <input type="number"name="basket"  id="edit_basket" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-slate-900" placeholder="1">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Quantity</label>
                            <input type="number" name="quantity" id="edit_quantity" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-slate-900" placeholder="0">
                        </div>
                    </div> --}}
                     <!-- Optional Fields -->
                    <div class="grid md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Price</label>
                            <input type="number" name="price" id="edit_price" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Image</label>
                            <input type="file" name="image"  class="w-full">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Description</label>
                        <textarea name="description" id="edit_description" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3"></textarea>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="document.getElementById('update-item-modal').classList.add('hidden')" class="flex-1 py-3 border border-slate-300 rounded-lg text-slate-600 font-semibold hover:bg-slate-50 transition">Cancel</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 rounded-lg text-white font-semibold hover:bg-blue-500 transition">Update Item</button>
                </div>
            </form>
        </div>
    </div>

    <div id="locationModal" class="hidden fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-3xl p-6 rounded-2xl">

            <h2 class="text-lg font-bold mb-4">Add Items</h2>

            <form method="POST" action="{{ route('locations.store') }}">
                @csrf

                <input type="hidden" name="product_id" id="product_id">

                <div id="location-wrapper">
                    <!-- Dynamic rows -->
                </div>

                <button type="button" onclick="addRow()" 
                    class="mt-3 mb-4 px-4 py-2 bg-slate-200 rounded-lg">
                    + Add More
                </button>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 bg-gray-300 rounded">Cancel</button>

                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
    let index = 0;

    function openLocationModal(productId) {
        document.getElementById('locationModal').classList.remove('hidden');
        document.getElementById('product_id').value = productId;

        document.getElementById('location-wrapper').innerHTML = '';
        index = 0;
        addRow();
    }

    function closeModal() {
        document.getElementById('locationModal').classList.add('hidden');
    }

    function addRow() {
        const wrapper = document.getElementById('location-wrapper');

        wrapper.innerHTML += `
            <div class="grid grid-cols-5 gap-2 mb-2">

                <!-- Aisle Dropdown -->
                <input name="locations[${index}][aisle]" 
                    placeholder="Aisle" type="text" 
                    class="border p-2 rounded">

                <input name="locations[${index}][rack]" 
                    placeholder="Rack" type="number" 
                    class="border p-2 rounded">

                <input name="locations[${index}][basket]" 
                    placeholder="Basket" type="number" 
                    class="border p-2 rounded">

                <input name="locations[${index}][quantity]" 
                    placeholder="Qty" type="number" 
                    class="border p-2 rounded">

                <input name="locations[${index}][expiry_date]" 
                    placeholder="Expiry" type="date" 
                    class="border p-2 rounded">
            </div>
        `;

        index++;
    }
</script>

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

    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const searchInput = document.getElementById("searchInput");
        const categoryFilter = document.getElementById("categoryFilter");
        const locationFilter = document.getElementById("locationFilter");

        const cards = document.querySelectorAll(".inventory-card");

        function filterProducts() {
            const search = searchInput.value.toLowerCase();
            const category = categoryFilter.value.toLowerCase();
            const location = locationFilter.value.toLowerCase();

            cards.forEach(card => {
                const name = card.dataset.name;
                const sku = card.dataset.sku;
                const cat = card.dataset.category;
                const loc = card.dataset.location;

                let matchSearch =
                    name.includes(search) ||
                    sku.includes(search) ||
                    loc.includes(search);

                let matchCategory =
                    category === "all categories" || cat.includes(category);

                let matchLocation =
                    location === "all locations" || loc.includes(location);

                if (matchSearch && matchCategory && matchLocation) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        // Event listeners
        searchInput.addEventListener("input", filterProducts);
        categoryFilter.addEventListener("change", filterProducts);
        locationFilter.addEventListener("change", filterProducts);
    });
    </script>

    <script>
    function openEditModal(btn) {

        const modal = document.getElementById('update-item-modal');
        modal.classList.remove('hidden');

        const id = btn.dataset.id;

        // SET FORM ACTION
        const form = document.getElementById('editForm');
        form.action = `/products/${id}`;

        // PREFILL VALUES
        document.getElementById('edit_title').value = btn.dataset.title;
        document.getElementById('edit_sku').value = btn.dataset.sku;
        document.getElementById('edit_category').value = btn.dataset.category;
        document.getElementById('edit_moq').value = btn.dataset.moq;
        document.getElementById('edit_shelf').value = btn.dataset.shelf;
        document.getElementById('edit_aisle').value = btn.dataset.aisle;
        document.getElementById('edit_rack').value = btn.dataset.rack;
        document.getElementById('edit_basket').value = btn.dataset.basket;
        document.getElementById('edit_quantity').value = btn.dataset.quantity;
        document.getElementById('edit_price').value = btn.dataset.price;
        document.getElementById('edit_description').value = btn.dataset.description;
        document.getElementById('edit_type').value = btn.dataset.type;
        document.getElementById('edit_brand').value = btn.dataset.brand;
    }
    </script>
</body>
</html>