<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks & Follow-ups | Sales Rep Portal</title>
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
                    <div>
                        <h1 class="font-display text-2xl font-bold text-slate-900">Tasks & Follow-ups</h1>
                        <p class="text-sm text-slate-500">Manage your daily activities and customer interactions</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="createTask()" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">New Task</span>
                    </button>
                    <button class="relative p-2 text-slate-600 hover:text-blue-900 transition">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">8</span>
                    </button>
                </div>
            </div>
        </header>

        <div class="p-6">
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Left Column: Task List -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Stats -->
                    <div class="grid grid-cols-4 gap-4">
                        <div class="bg-white rounded-xl p-4 border border-slate-200">
                            <p class="text-sm text-slate-500">Pending</p>
                            <p class="text-2xl font-bold text-amber-600">5</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-slate-200">
                            <p class="text-sm text-slate-500">Today</p>
                            <p class="text-2xl font-bold text-blue-900">3</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-slate-200">
                            <p class="text-sm text-slate-500">Overdue</p>
                            <p class="text-2xl font-bold text-red-600">1</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-slate-200">
                            <p class="text-sm text-slate-500">Completed</p>
                            <p class="text-2xl font-bold text-emerald-600">12</p>
                        </div>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="bg-white rounded-xl p-2 border border-slate-200 flex gap-2">
                        <button class="flex-1 py-2 px-4 rounded-lg text-sm font-medium bg-blue-900 text-white" onclick="filterTasks('all')">All Tasks</button>
                        <button class="flex-1 py-2 px-4 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50" onclick="filterTasks('calls')">Calls</button>
                        <button class="flex-1 py-2 px-4 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50" onclick="filterTasks('visits')">Visits</button>
                        <button class="flex-1 py-2 px-4 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50" onclick="filterTasks('followups')">Follow-ups</button>
                    </div>

                    <!-- High Priority Tasks -->
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                            High Priority
                        </h3>
                        <div class="space-y-3">
                            <div class="task-card high" onclick="viewTask(1)">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-blue-900 focus:ring-blue-900" onclick="event.stopPropagation()">
                                        <div>
                                            <h4 class="font-semibold text-slate-900">Call London Bistro - Urgent Order Discussion</h4>
                                            <p class="text-sm text-slate-500">Customer reported 45% order reduction. Need to understand issues.</p>
                                        </div>
                                    </div>
                                    <span class="priority-badge priority-high">
                                        <i class="fas fa-flag"></i>
                                        High
                                    </span>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-slate-500 ml-8">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-phone text-blue-900"></i>
                                        Call
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-building text-slate-400"></i>
                                        London Bistro Ltd
                                    </span>
                                    <span class="flex items-center gap-1 text-red-600">
                                        <i class="fas fa-clock"></i>
                                        Today, 10:00 AM
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medium Priority Tasks -->
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                            Medium Priority
                        </h3>
                        <div class="space-y-3">
                            <div class="task-card medium" onclick="viewTask(2)">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-blue-900 focus:ring-blue-900" onclick="event.stopPropagation()">
                                        <div>
                                            <h4 class="font-semibold text-slate-900">Follow up West End Catering - Price Negotiation</h4>
                                            <p class="text-sm text-slate-500">Discuss volume discount for increased order commitment.</p>
                                        </div>
                                    </div>
                                    <span class="priority-badge priority-medium">
                                        <i class="fas fa-flag"></i>
                                        Medium
                                    </span>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-slate-500 ml-8">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-envelope text-blue-900"></i>
                                        Email
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-building text-slate-400"></i>
                                        West End Catering
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-clock"></i>
                                        Today, 2:00 PM
                                    </span>
                                </div>
                            </div>

                            <div class="task-card medium" onclick="viewTask(3)">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-blue-900 focus:ring-blue-900" onclick="event.stopPropagation()">
                                        <div>
                                            <h4 class="font-semibold text-slate-900">Site Visit - The Crown Pub Product Sampling</h4>
                                            <p class="text-sm text-slate-500">Present new beverage lineup and take feedback.</p>
                                        </div>
                                    </div>
                                    <span class="priority-badge priority-medium">
                                        <i class="fas fa-flag"></i>
                                        Medium
                                    </span>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-slate-500 ml-8">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-walking text-blue-900"></i>
                                        Visit
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-building text-slate-400"></i>
                                        The Crown Pub
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-clock"></i>
                                        Today, 4:00 PM
                                    </span>
                                </div>
                            </div>

                            <div class="task-card medium" onclick="viewTask(4)">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-blue-900 focus:ring-blue-900" onclick="event.stopPropagation()">
                                        <div>
                                            <h4 class="font-semibold text-slate-900">Check in with Riverside Restaurant</h4>
                                            <p class="text-sm text-slate-500">15 days since last order. Verify if they need assistance.</p>
                                        </div>
                                    </div>
                                    <span class="priority-badge priority-medium">
                                        <i class="fas fa-flag"></i>
                                        Medium
                                    </span>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-slate-500 ml-8">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-phone text-blue-900"></i>
                                        Call
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-building text-slate-400"></i>
                                        Riverside Restaurant
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-clock"></i>
                                        Tomorrow, 9:00 AM
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Low Priority Tasks -->
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                            Low Priority
                        </h3>
                        <div class="space-y-3">
                            <div class="task-card low" onclick="viewTask(5)">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-blue-900 focus:ring-blue-900" onclick="event.stopPropagation()">
                                        <div>
                                            <h4 class="font-semibold text-slate-900">Send price list to Northside Cafe</h4>
                                            <p class="text-sm text-slate-500">New customer requested Q2 2026 pricing.</p>
                                        </div>
                                    </div>
                                    <span class="priority-badge priority-low">
                                        <i class="fas fa-flag"></i>
                                        Low
                                    </span>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-slate-500 ml-8">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-envelope text-blue-900"></i>
                                        Email
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-building text-slate-400"></i>
                                        Northside Cafe
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-clock"></i>
                                        This Week
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Calendar & Quick Actions -->
                <div class="space-y-6">
                    <!-- Mini Calendar -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-slate-900">April 2026</h3>
                            <div class="flex gap-2">
                                <button class="p-1 hover:bg-slate-100 rounded"><i class="fas fa-chevron-left"></i></button>
                                <button class="p-1 hover:bg-slate-100 rounded"><i class="fas fa-chevron-right"></i></button>
                            </div>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center text-xs mb-2">
                            <span class="text-slate-400">Su</span>
                            <span class="text-slate-400">Mo</span>
                            <span class="text-slate-400">Tu</span>
                            <span class="text-slate-400">We</span>
                            <span class="text-slate-400">Th</span>
                            <span class="text-slate-400">Fr</span>
                            <span class="text-slate-400">Sa</span>
                        </div>
                        <div class="grid grid-cols-7 gap-1">
                            <span class="calendar-day text-slate-300">30</span>
                            <span class="calendar-day text-slate-300">31</span>
                            <span class="calendar-day">1</span>
                            <span class="calendar-day active has-tasks">2</span>
                            <span class="calendar-day has-tasks">3</span>
                            <span class="calendar-day">4</span>
                            <span class="calendar-day">5</span>
                            <span class="calendar-day">6</span>
                            <span class="calendar-day has-tasks">7</span>
                            <span class="calendar-day">8</span>
                            <span class="calendar-day">9</span>
                            <span class="calendar-day has-tasks">10</span>
                            <span class="calendar-day">11</span>
                            <span class="calendar-day">12</span>
                            <span class="calendar-day">13</span>
                            <span class="calendar-day">14</span>
                            <span class="calendar-day has-tasks">15</span>
                            <span class="calendar-day">16</span>
                            <span class="calendar-day">17</span>
                            <span class="calendar-day">18</span>
                            <span class="calendar-day">19</span>
                            <span class="calendar-day">20</span>
                            <span class="calendar-day">21</span>
                            <span class="calendar-day">22</span>
                            <span class="calendar-day">23</span>
                            <span class="calendar-day">24</span>
                            <span class="calendar-day">25</span>
                            <span class="calendar-day">26</span>
                            <span class="calendar-day">27</span>
                            <span class="calendar-day">28</span>
                            <span class="calendar-day">29</span>
                            <span class="calendar-day">30</span>
                        </div>
                    </div>

                    <!-- Today's Schedule -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Today's Schedule</h3>
                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <div class="w-16 text-sm text-slate-500 text-right pt-1">10:00</div>
                                <div class="flex-1 pb-4 border-l-2 border-red-400 pl-4">
                                    <p class="font-medium text-slate-900">Call London Bistro</p>
                                    <p class="text-xs text-slate-500">Order reduction discussion</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-16 text-sm text-slate-500 text-right pt-1">14:00</div>
                                <div class="flex-1 pb-4 border-l-2 border-amber-400 pl-4">
                                    <p class="font-medium text-slate-900">Email West End</p>
                                    <p class="text-xs text-slate-500">Price negotiation</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-16 text-sm text-slate-500 text-right pt-1">16:00</div>
                                <div class="flex-1 border-l-2 border-amber-400 pl-4">
                                    <p class="font-medium text-slate-900">Site Visit - The Crown</p>
                                    <p class="text-xs text-slate-500">Product sampling</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Templates -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Quick Templates</h3>
                        <div class="space-y-2">
                            <button onclick="useTemplate('followup')" class="w-full text-left px-4 py-3 bg-slate-50 rounded-lg hover:bg-slate-100 transition text-sm">
                                <i class="fas fa-reply mr-2 text-blue-900"></i>
                                Follow-up Email
                            </button>
                            <button onclick="useTemplate('checkin')" class="w-full text-left px-4 py-3 bg-slate-50 rounded-lg hover:bg-slate-100 transition text-sm">
                                <i class="fas fa-phone mr-2 text-blue-900"></i>
                                Check-in Call Script
                            </button>
                            <button onclick="useTemplate('proposal')" class="w-full text-left px-4 py-3 bg-slate-50 rounded-lg hover:bg-slate-100 transition text-sm">
                                <i class="fas fa-file-alt mr-2 text-blue-900"></i>
                                Proposal Template
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