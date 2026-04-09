<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Customers | Sales Rep Portal</title>
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
                <a href="sales_dashboard.html" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                    <span class="nav-text">Dashboard</span>
                    <span class="tooltip">Dashboard</span>
                </a>
                <a href="sales_customers.html" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-users"></i></span>
                    <span class="nav-text">My Customers</span>
                    <span class="nav-badge">3</span>
                    <span class="tooltip">My Customers</span>
                </a>
                <a href="sales_orders.html" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                    <span class="nav-text">All Orders</span>
                    <span class="tooltip">All Orders</span>
                </a>
                <a href="sales_tasks.html" class="nav-item [ACTIVE_CLASS]">
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
                <a href="sales_performance.html" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
                    <span class="nav-text">Performance</span>
                    <span class="tooltip">Performance</span>
                </a>
                <a href="sales_commissions.html" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-pound-sign"></i></span>
                    <span class="nav-text">Commissions</span>
                    <span class="tooltip">Commissions</span>
                </a>
                <a href="sales_targets.html" class="nav-item [ACTIVE_CLASS]">
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
                        <h1 class="font-display text-2xl font-bold text-slate-900">My Customers</h1>
                        <p class="text-sm text-slate-500">Manage and monitor your customer portfolio</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="addCustomer()" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">Add Customer</span>
                    </button>
                    <button class="relative p-2 text-slate-600 hover:text-blue-900 transition">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">8</span>
                    </button>
                </div>
            </div>
        </header>

        <div class="p-6">
            <!-- Stats Overview -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 border border-slate-200">
                    <p class="text-sm text-slate-500">Total Customers</p>
                    <p class="text-2xl font-bold text-slate-900">24</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-200">
                    <p class="text-sm text-slate-500">Healthy</p>
                    <p class="text-2xl font-bold text-emerald-600">18</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-red-100 bg-red-50">
                    <p class="text-sm text-red-600">At Risk</p>
                    <p class="text-2xl font-bold text-red-600">3</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-amber-100 bg-amber-50">
                    <p class="text-sm text-amber-600">Declining</p>
                    <p class="text-2xl font-bold text-amber-600">3</p>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-xl p-4 mb-6 border border-slate-200">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-sm font-semibold text-slate-700">Filter:</span>
                    <button class="filter-btn active" onclick="filterCustomers('all', this)">All Customers</button>
                    <button class="filter-btn" onclick="filterCustomers('at-risk', this)">
                        <i class="fas fa-exclamation-circle mr-1"></i>At Risk
                    </button>
                    <button class="filter-btn" onclick="filterCustomers('declining', this)">
                        <i class="fas fa-arrow-down mr-1"></i>Declining
                    </button>
                    <button class="filter-btn" onclick="filterCustomers('healthy', this)">
                        <i class="fas fa-check-circle mr-1"></i>Healthy
                    </button>
                    <button class="filter-btn" onclick="filterCustomers('new', this)">
                        <i class="fas fa-star mr-1"></i>New
                    </button>
                    <div class="ml-auto flex items-center gap-2">
                        <input type="text" placeholder="Search customers..." class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-blue-900">
                        <button class="p-2 text-slate-600 hover:text-blue-900">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Customer Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="customer-grid">

                <!-- Customer 1: At Risk -->
                <div class="customer-card border-red-200" data-status="at-risk">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-900 font-bold text-lg">
                                LB
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">London Bistro Ltd</h3>
                                <p class="text-xs text-slate-500">ID: CLB-001 • Gold Tier</p>
                            </div>
                        </div>
                        <div class="health-indicator health-danger" title="At Risk"></div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Last Order</span>
                            <span class="text-sm font-medium text-slate-900">Today</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Order Frequency</span>
                            <span class="text-sm font-medium text-slate-900">Weekly</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Avg Order Value</span>
                            <span class="text-sm font-medium text-slate-900">£8,500</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">This Month</span>
                            <span class="text-sm font-medium text-red-600">£4,250</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="trend-badge trend-down">
                                <i class="fas fa-arrow-down"></i>
                                -45%
                            </span>
                            <span class="text-xs text-slate-400">vs avg</span>
                        </div>
                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-medium">URGENT</span>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500 mb-2">Contact: James Wilson (Owner)</p>
                        <p class="text-xs text-slate-500 mb-3">020 7946 0123</p>
                        <div class="flex gap-2">
                            <button onclick="viewCustomer('CLB-001')" class="flex-1 py-2 bg-blue-900 text-white rounded-lg text-sm hover:bg-blue-800 transition">
                                View Details
                            </button>
                            <button onclick="callCustomer('CLB-001')" class="px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button onclick="emailCustomer('CLB-001')" class="px-3 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                                <i class="fas fa-envelope"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Customer 2: Declining -->
                <div class="customer-card border-amber-200" data-status="declining">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-900 font-bold text-lg">
                                WE
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">West End Catering</h3>
                                <p class="text-xs text-slate-500">ID: CWE-002 • Platinum Tier</p>
                            </div>
                        </div>
                        <div class="health-indicator health-warning" title="Declining"></div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Last Order</span>
                            <span class="text-sm font-medium text-slate-900">Yesterday</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Order Frequency</span>
                            <span class="text-sm font-medium text-slate-900">Bi-weekly</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Avg Order Value</span>
                            <span class="text-sm font-medium text-slate-900">£12,000</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">This Month</span>
                            <span class="text-sm font-medium text-amber-600">£9,400</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="trend-badge trend-down">
                                <i class="fas fa-arrow-down"></i>
                                -22%
                            </span>
                            <span class="text-xs text-slate-400">vs avg</span>
                        </div>
                        <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded text-xs font-medium">FOLLOW UP</span>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500 mb-2">Contact: Sarah Chen (Procurement)</p>
                        <p class="text-xs text-slate-500 mb-3">020 7946 0456</p>
                        <div class="flex gap-2">
                            <button onclick="viewCustomer('CWE-002')" class="flex-1 py-2 bg-blue-900 text-white rounded-lg text-sm hover:bg-blue-800 transition">
                                View Details
                            </button>
                            <button onclick="callCustomer('CWE-002')" class="px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button onclick="emailCustomer('CWE-002')" class="px-3 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                                <i class="fas fa-envelope"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Customer 3: Stale/No Order -->
                <div class="customer-card border-amber-200" data-status="declining">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center text-amber-900 font-bold text-lg">
                                RR
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Riverside Restaurant</h3>
                                <p class="text-xs text-slate-500">ID: CRR-003 • Gold Tier</p>
                            </div>
                        </div>
                        <div class="health-indicator health-warning" title="Stale"></div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Last Order</span>
                            <span class="text-sm font-medium text-red-600">15 days ago</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Order Frequency</span>
                            <span class="text-sm font-medium text-slate-900">Weekly (Missed)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Avg Order Value</span>
                            <span class="text-sm font-medium text-slate-900">£6,800</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">This Month</span>
                            <span class="text-sm font-medium text-slate-900">£6,750</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="trend-badge trend-down">
                                <i class="fas fa-minus"></i>
                                0%
                            </span>
                            <span class="text-xs text-slate-400">vs avg</span>
                        </div>
                        <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded text-xs font-medium">CHECK IN</span>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500 mb-2">Contact: Michael Brown (Manager)</p>
                        <p class="text-xs text-slate-500 mb-3">020 7946 0789</p>
                        <div class="flex gap-2">
                            <button onclick="viewCustomer('CRR-003')" class="flex-1 py-2 bg-blue-900 text-white rounded-lg text-sm hover:bg-blue-800 transition">
                                View Details
                            </button>
                            <button onclick="callCustomer('CRR-003')" class="px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button onclick="emailCustomer('CRR-003')" class="px-3 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                                <i class="fas fa-envelope"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Customer 4: Healthy -->
                <div class="customer-card" data-status="healthy">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-900 font-bold text-lg">
                                TC
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">The Crown Pub</h3>
                                <p class="text-xs text-slate-500">ID: CTC-004 • Silver Tier</p>
                            </div>
                        </div>
                        <div class="health-indicator health-good" title="Healthy"></div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Last Order</span>
                            <span class="text-sm font-medium text-slate-900">Mar 30, 2026</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Order Frequency</span>
                            <span class="text-sm font-medium text-slate-900">Every 10 days</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Avg Order Value</span>
                            <span class="text-sm font-medium text-slate-900">£2,500</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">This Month</span>
                            <span class="text-sm font-medium text-emerald-600">£2,850</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="trend-badge trend-up">
                                <i class="fas fa-arrow-up"></i>
                                +15%
                            </span>
                            <span class="text-xs text-slate-400">vs avg</span>
                        </div>
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium">HEALTHY</span>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500 mb-2">Contact: Emma Davis (Owner)</p>
                        <p class="text-xs text-slate-500 mb-3">020 7946 0321</p>
                        <div class="flex gap-2">
                            <button onclick="viewCustomer('CTC-004')" class="flex-1 py-2 bg-blue-900 text-white rounded-lg text-sm hover:bg-blue-800 transition">
                                View Details
                            </button>
                            <button onclick="callCustomer('CTC-004')" class="px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button onclick="emailCustomer('CTC-004')" class="px-3 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                                <i class="fas fa-envelope"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Customer 5: Healthy -->
                <div class="customer-card" data-status="healthy">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center text-pink-900 font-bold text-lg">
                                HG
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Highbury Gardens Hotel</h3>
                                <p class="text-xs text-slate-500">ID: CHG-005 • Platinum Tier</p>
                            </div>
                        </div>
                        <div class="health-indicator health-good" title="Healthy"></div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Last Order</span>
                            <span class="text-sm font-medium text-slate-900">Apr 1, 2026</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Order Frequency</span>
                            <span class="text-sm font-medium text-slate-900">Weekly</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Avg Order Value</span>
                            <span class="text-sm font-medium text-slate-900">£15,000</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">This Month</span>
                            <span class="text-sm font-medium text-emerald-600">£15,200</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="trend-badge trend-up">
                                <i class="fas fa-arrow-up"></i>
                                +8%
                            </span>
                            <span class="text-xs text-slate-400">vs avg</span>
                        </div>
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium">HEALTHY</span>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500 mb-2">Contact: Robert Taylor (F&B Manager)</p>
                        <p class="text-xs text-slate-500 mb-3">020 7946 0654</p>
                        <div class="flex gap-2">
                            <button onclick="viewCustomer('CHG-005')" class="flex-1 py-2 bg-blue-900 text-white rounded-lg text-sm hover:bg-blue-800 transition">
                                View Details
                            </button>
                            <button onclick="callCustomer('CHG-005')" class="px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button onclick="emailCustomer('CHG-005')" class="px-3 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                                <i class="fas fa-envelope"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Customer 6: New -->
                <div class="customer-card" data-status="new">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-900 font-bold text-lg">
                                NC
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Northside Cafe</h3>
                                <p class="text-xs text-slate-500">ID: CNC-006 • Bronze Tier</p>
                            </div>
                        </div>
                        <div class="health-indicator health-good" title="New Customer"></div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Last Order</span>
                            <span class="text-sm font-medium text-slate-900">Mar 28, 2026</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Order Frequency</span>
                            <span class="text-sm font-medium text-slate-900">Establishing</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Avg Order Value</span>
                            <span class="text-sm font-medium text-slate-900">£1,200</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">This Month</span>
                            <span class="text-sm font-medium text-slate-900">£1,200</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-slate-400">First order Mar 2026</span>
                        </div>
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-medium">NEW</span>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500 mb-2">Contact: Lisa Johnson (Owner)</p>
                        <p class="text-xs text-slate-500 mb-3">020 7946 0987</p>
                        <div class="flex gap-2">
                            <button onclick="viewCustomer('CNC-006')" class="flex-1 py-2 bg-blue-900 text-white rounded-lg text-sm hover:bg-blue-800 transition">
                                View Details
                            </button>
                            <button onclick="callCustomer('CNC-006')" class="px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button onclick="emailCustomer('CNC-006')" class="px-3 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                                <i class="fas fa-envelope"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-8">
                <p class="text-sm text-slate-500">Showing 6 of 24 customers</p>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50 disabled:opacity-50" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-4 py-2 bg-blue-900 text-white rounded-lg text-sm">1</button>
                    <button class="px-4 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">2</button>
                    <button class="px-4 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">3</button>
                    <button class="px-3 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">
                        <i class="fas fa-chevron-right"></i>
                    </button>
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