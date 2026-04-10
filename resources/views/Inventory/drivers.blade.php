<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Management | NextBee B2B</title>
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

        .driver-card { 
            transition: all 0.3s ease; 
            background: white;
            border: 1px solid #e2e8f0;
        }
        .driver-card:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 20px 40px rgba(0,0,0,0.1); 
            border-color: #3b82f6;
        }
        .status-online { background: #10b981; }
        .status-offline { background: #64748b; }
        .status-delivering { background: #3b82f6; animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }

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
                    <a href="/drivers" class="nav-item active">
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
                        <h1 class="font-display text-2xl font-bold text-slate-900">Driver Management</h1>
                        <p class="text-sm text-slate-500">Fleet operations & driver registry</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-slate-500" id="current-date"></span>
                    <button class="relative p-2 text-slate-600 hover:text-blue-900 transition" aria-label="Notifications">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">8</span>
                    </button>
                    <button onclick="document.getElementById('add-driver-modal').classList.remove('hidden')" 
                            class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg text-sm font-semibold text-white transition flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">Register Driver</span>
                    </button>
                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-sm font-bold text-slate-700 border-2 border-white shadow">
                        AD
                    </div>
                </div>
            </div>
        </header>

        <div class="p-6">
            <!-- Stats Overview -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Drivers</div>
                        <span class="text-blue-600 text-xs font-semibold bg-blue-50 px-2 py-1 rounded">Fleet</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-900 font-display">{{ $totalDrivers }}</div>
                    <div class="text-xs text-slate-500 mt-1">Active roster</div>
                </div>
                {{-- <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Active Now</div>
                        <span class="text-emerald-600 text-xs font-semibold bg-emerald-50 px-2 py-1 rounded">Online</span>
                    </div>
                    <div class="text-3xl font-bold text-emerald-600 font-display">18</div>
                    <div class="text-xs text-slate-500 mt-1">Currently working</div>
                </div>
                <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">On Delivery</div>
                        <span class="text-blue-600 text-xs font-semibold bg-blue-50 px-2 py-1 rounded">Busy</span>
                    </div>
                    <div class="text-3xl font-bold text-blue-600 font-display">12</div>
                    <div class="text-xs text-slate-500 mt-1">In transit</div>
                </div>
                <div class="glass rounded-2xl p-6 border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Off Duty</div>
                        <span class="text-slate-600 text-xs font-semibold bg-slate-100 px-2 py-1 rounded">Rest</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-600 font-display">5</div>
                    <div class="text-xs text-slate-500 mt-1">Break / End shift</div>
                </div> --}}
            </div>

            <!-- Driver Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Driver 1: On Delivery -->
                {{-- <div class="driver-card rounded-2xl p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-2xl font-bold text-blue-600">JD</div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 rounded-full status-delivering border-2 border-white"></div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">John Davies</h3>
                                <p class="text-xs text-slate-500">Driver ID: DRV-001</p>
                                <p class="text-xs text-blue-600 font-semibold mt-1">● On Delivery</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Vehicle</span>
                            <span class="text-slate-900 font-medium">VAN-04 (Ford Transit)</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Phone</span>
                            <span class="text-slate-900 font-medium">07879 123456</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">License</span>
                            <span class="text-emerald-600 font-medium">Valid until 2027</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Today's Route</span>
                            <span class="text-slate-900 font-medium">Route A-04 (8/12 stops)</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-slate-900">847</p>
                            <p class="text-[10px] text-slate-500 uppercase">Deliveries</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-emerald-600">98%</p>
                            <p class="text-[10px] text-slate-500 uppercase">On Time</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-slate-900">4.9</p>
                            <p class="text-[10px] text-slate-500 uppercase">Rating</p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-sm font-semibold text-white transition">Track Live</button>
                        <button class="flex-1 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-semibold transition">History</button>
                    </div>
                </div> --}}
                @foreach($drivers as $driver)
                <div class="driver-card rounded-2xl p-6">

                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">

                            <!-- Avatar (Initials) -->
                            @php
                                $nameParts = explode(' ', $driver->name);
                                $initials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
                            @endphp

                            <div class="relative">
                                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-2xl font-bold text-blue-600">
                                    {{ $initials }}
                                </div>

                                <!-- Status Dot -->
                                <div class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-green-500 border-2 border-white"></div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-slate-900">
                                    {{ $driver->name }}
                                </h3>

                                <p class="text-xs text-slate-500">
                                    Driver ID: DRV-{{ str_pad($driver->id, 3, '0', STR_PAD_LEFT) }}
                                </p>

                                <p class="text-xs text-blue-600 font-semibold mt-1">
                                    ● Active
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Vehicle</span>
                            <span class="text-slate-900 font-medium">
                                {{ $driver->assigned_vehicle ?? 'N/A' }}
                            </span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Phone</span>
                            <span class="text-slate-900 font-medium">
                                {{ $driver->phone }}
                            </span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">License</span>
                            <span class="text-emerald-600 font-medium">
                                Valid till {{ \Carbon\Carbon::parse($driver->licence_expiry)->format('Y') }}
                            </span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Status</span>
                            <span class="text-slate-900 font-medium">
                                Available
                            </span>
                        </div>
                    </div>

                    <!-- Stats (Static for now) -->
                    <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                        <div class="p-2 bg-slate-50 rounded-lg border">
                            <p class="text-lg font-bold text-slate-900">--</p>
                            <p class="text-[10px] text-slate-500 uppercase">Deliveries</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border">
                            <p class="text-lg font-bold text-emerald-600">--</p>
                            <p class="text-[10px] text-slate-500 uppercase">On Time</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border">
                            <p class="text-lg font-bold text-slate-900">--</p>
                            <p class="text-[10px] text-slate-500 uppercase">Rating</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <button class="flex-1 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold">
                            Track
                        </button>
                        <button class="flex-1 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-semibold">
                            Details
                        </button>
                    </div>

                </div>
                @endforeach

                <!-- Driver 2: Loading -->
                {{-- <div class="driver-card rounded-2xl p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center text-2xl font-bold text-purple-600">SM</div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 rounded-full status-delivering border-2 border-white"></div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Sarah Miller</h3>
                                <p class="text-xs text-slate-500">Driver ID: DRV-002</p>
                                <p class="text-xs text-amber-600 font-semibold mt-1">● Loading</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Vehicle</span>
                            <span class="text-slate-900 font-medium">VAN-12 (Mercedes Sprinter)</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Phone</span>
                            <span class="text-slate-900 font-medium">07879 234567</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">License</span>
                            <span class="text-emerald-600 font-medium">Valid until 2028</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Today's Route</span>
                            <span class="text-slate-900 font-medium">Route B-12 (0/15 stops)</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-slate-900">623</p>
                            <p class="text-[10px] text-slate-500 uppercase">Deliveries</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-emerald-600">96%</p>
                            <p class="text-[10px] text-slate-500 uppercase">On Time</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-slate-900">4.8</p>
                            <p class="text-[10px] text-slate-500 uppercase">Rating</p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 py-2 bg-amber-100 text-amber-700 border border-amber-200 rounded-lg text-sm font-semibold transition">Monitor Loading</button>
                        <button class="flex-1 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-semibold transition">History</button>
                    </div>
                </div> --}}

                <!-- Driver 3: Off Duty -->
                {{-- <div class="driver-card rounded-2xl p-6 opacity-75">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-2xl font-bold text-slate-500">RK</div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 rounded-full status-offline border-2 border-white"></div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-700">Robert King</h3>
                                <p class="text-xs text-slate-400">Driver ID: DRV-003</p>
                                <p class="text-xs text-slate-500 font-semibold mt-1">○ Off Duty</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Vehicle</span>
                            <span class="text-slate-700 font-medium">VAN-07 (Ford Transit)</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Phone</span>
                            <span class="text-slate-700 font-medium">07879 345678</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">License</span>
                            <span class="text-emerald-600 font-medium">Valid until 2026</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Last Route</span>
                            <span class="text-slate-700 font-medium">Route C-07 (Completed)</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-slate-600">1,204</p>
                            <p class="text-[10px] text-slate-400 uppercase">Deliveries</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-emerald-600">99%</p>
                            <p class="text-[10px] text-slate-400 uppercase">On Time</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-slate-600">5.0</p>
                            <p class="text-[10px] text-slate-400 uppercase">Rating</p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg text-sm font-semibold transition">Assign Route</button>
                        <button class="flex-1 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-semibold transition">History</button>
                    </div>
                </div> --}}

                <!-- Driver 4: On Delivery -->
                {{-- <div class="driver-card rounded-2xl p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center text-2xl font-bold text-emerald-600">MP</div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 rounded-full status-delivering border-2 border-white"></div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Maria Patel</h3>
                                <p class="text-xs text-slate-500">Driver ID: DRV-004</p>
                                <p class="text-xs text-blue-600 font-semibold mt-1">● On Delivery</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Vehicle</span>
                            <span class="text-slate-900 font-medium">VAN-15 (VW Crafter)</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Phone</span>
                            <span class="text-slate-900 font-medium">07879 456789</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">License</span>
                            <span class="text-emerald-600 font-medium">Valid until 2029</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Today's Route</span>
                            <span class="text-slate-900 font-medium">Route D-15 (5/10 stops)</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-slate-900">445</p>
                            <p class="text-[10px] text-slate-500 uppercase">Deliveries</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-emerald-600">97%</p>
                            <p class="text-[10px] text-slate-500 uppercase">On Time</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                            <p class="text-lg font-bold text-slate-900">4.9</p>
                            <p class="text-[10px] text-slate-500 uppercase">Rating</p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-sm font-semibold text-white transition">Track Live</button>
                        <button class="flex-1 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-semibold transition">History</button>
                    </div>
                </div> --}}

            </div>
        </div>
    </main>

    <!-- Add Driver Modal -->
    <div id="add-driver-modal" class="hidden fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-lg w-full shadow-2xl border border-slate-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-slate-900 font-display">Register New Driver</h2>
                <button onclick="document.getElementById('add-driver-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
            </div>

            <form action="{{ route('register-driver') }}" method="POST" class="space-y-4">
            @csrf
                <div class="grid md:grid-cols-1 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Full Name</label>
                        <input type="text" name="name" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="John">
                    </div>
                    {{-- <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Last Name</label>
                        <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="Smith">
                    </div> --}}
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Email</label>
                    <input type="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="Smith">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Phone Number</label>
                    <input type="text" name="phone" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="07879 000000">
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">License Number</label>
                        <input type="text" name="licence_no" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none" placeholder="SMITH901234AB5CD">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">License Expiry</label>
                        <input type="date" name="licence_expiry" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Assigned Vehicle</label>
                    <select name="assigned_vehicle" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none">
                        <option>VAN-04 (Ford Transit)</option>
                        <option>VAN-07 (Ford Transit)</option>
                        <option>VAN-12 (Mercedes Sprinter)</option>
                        <option>VAN-15 (VW Crafter)</option>
                        <option>Unassigned</option>
                    </select>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="document.getElementById('add-driver-modal').classList.add('hidden')" class="flex-1 py-3 border border-slate-300 rounded-lg text-slate-600 font-semibold hover:bg-slate-50 transition">Cancel</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 rounded-lg text-white font-semibold hover:bg-blue-500 transition">Register Driver</button>
                </div>
            </form>
        </div>
    </div>

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