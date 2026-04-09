<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2B Customers | NextBee B2B</title>
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
    
        /* Main Content - FIXED */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            background: #f1f5f9;
        }
    
        /* FIXED: Use body class for reliable toggling */
        body.sidebar-is-collapsed .main-content {
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
    
        /* Card styles for light theme */
        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
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
    
        /* Keyboard focus styles for accessibility */
        .nav-item:focus-visible,
        .section-header:focus-visible,
        .sidebar-toggle:focus-visible,
        .logout-btn:focus-visible {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }
    
        /* Page-specific styles */
        .customer-tier-gold { border-left: 4px solid #fbbf24; }
        .customer-tier-silver { border-left: 4px solid #94a3b8; }
        .customer-tier-bronze { border-left: 4px solid #b45309; }
    </style>


    <script>
    // ===== SIDEBAR COLLAPSE FUNCTIONALITY =====

    // Initialize sidebar state from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const body = document.body;
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        
        if (isCollapsed && window.innerWidth > 1024) {
            sidebar.classList.add('collapsed');
            body.classList.add('sidebar-is-collapsed');
        }
        
        // Initialize section states from localStorage
        const sections = ['section-operations', 'section-management', 'section-sales'];
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
        const body = document.body;
        
        sidebar.classList.toggle('collapsed');
        body.classList.toggle('sidebar-is-collapsed');
        
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
</head>
<body class="min-h-screen">
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
                <a href="/inventory/dashboard" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                    <span class="nav-text">Dashboard</span>
                    <span class="tooltip">Dashboard</span>
                </a>
                <a href="/inventory-page" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-boxes"></i></span>
                    <span class="nav-text">Inventory</span>
                    <span class="nav-badge">47</span>
                    <span class="tooltip">Inventory</span>
                </a>
                <a href="/deliveries" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-truck"></i></span>
                    <span class="nav-text">Deliveries</span>
                    <span class="nav-badge warning">156</span>
                    <span class="tooltip">Deliveries</span>
                </a>
                <a href="/drivers" class="nav-item [ACTIVE_CLASS]">
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
                <a href="/customers" class="nav-item active">
                    <span class="nav-icon"><i class="fas fa-store"></i></span>
                    <span class="nav-text">Customers</span>
                    <span class="tooltip">Customers</span>
                </a>
                <a href="/returns" class="nav-item [ACTIVE_CLASS]">
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
                <a href="/sales-dashboard" class="nav-item [ACTIVE_CLASS]">
                    <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
                    <span class="nav-text">Sales Dashboard</span>
                    <span class="tooltip">Sales Dashboard</span>
                </a>
                <a href="/sales-orders" class="nav-item [ACTIVE_CLASS]">
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

<main class="main-content">
    <!-- Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center gap-4">
                <button class="mobile-toggle p-2 hover:bg-slate-100 rounded-lg" onclick="openMobileSidebar()" aria-label="Open menu">
                    <i class="fas fa-bars text-slate-600 text-xl"></i>
                </button>
                <div>
                    <h1 class="font-display text-2xl font-bold text-slate-900">B2B Customers</h1>
                    <p class="text-sm text-slate-500">Manage customer accounts and relationships</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button onclick="document.getElementById('add-customer-modal').classList.remove('hidden')" 
                        class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg text-sm font-semibold text-white transition">
                    + Add Customer
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

    <!-- Content area -->
    <div class="p-6">
        <!-- Stats & Filters -->
        <div class="card p-6 mb-6">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                <div class="text-center p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <p class="text-2xl font-bold text-slate-900 font-display">{{ $totalCustomers }}</p>
                    <p class="text-xs text-slate-500 uppercase font-medium mt-1">Total Customers</p>
                </div>
                <div class="text-center p-4 bg-emerald-50 rounded-xl border border-emerald-200">
                    <p class="text-2xl font-bold text-emerald-600 font-display">{{ $activeCustomers }}</p>
                    <p class="text-xs text-emerald-600 uppercase font-medium mt-1">Active</p>
                </div>
                <div class="text-center p-4 bg-amber-50 rounded-xl border border-amber-200">
                    <p class="text-2xl font-bold text-amber-600 font-display">{{ $pendingCustomers }}</p>
                    <p class="text-xs text-amber-600 uppercase font-medium mt-1">Pending Setup</p>
                </div>
                <div class="text-center p-4 bg-red-50 rounded-xl border border-red-200">
                    <p class="text-2xl font-bold text-red-600 font-display">{{ $inactiveCustomers }}</p>
                    <p class="text-xs text-red-600 uppercase font-medium mt-1">Inactive</p>
                </div>
                <div class="text-center p-4 bg-blue-50 rounded-xl border border-blue-200">
                    <p class="text-2xl font-bold text-blue-600 font-display">{{ $churnRiskCustomers }}</p>
                    <p class="text-xs text-blue-600 uppercase font-medium mt-1">Churn Risk</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-4">
                <div class="relative flex-1">
                    <input type="text" id="customerSearch" placeholder="Search business name, contact, or postcode..." 
                           class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <span class="absolute right-3 top-3.5 text-slate-400">🔍</span>
                </div>
                <select id="tierFilter" class="bg-white border border-slate-300 rounded-lg px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-blue-500">
                    <option value="">All Tiers</option>
                    <option value="gold">Gold (High Volume)</option>
                    <option value="silver">Silver (Regular)</option>
                    <option value="bronze">Bronze (Occasional)</option>
                </select>
                <select id="statusFilter" class="bg-white border border-slate-300 rounded-lg px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="churn">Churn Risk</option>
                </select>
            </div>
        </div>

        <!-- Customer List -->
        <div class="space-y-4">
            
            <!-- Customer 1: Gold Tier -->
            {{-- <div class="card p-6 customer-tier-gold">
                <div class="flex flex-col lg:flex-row gap-6 justify-between">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-full bg-amber-100 flex items-center justify-center text-2xl border-2 border-amber-200">🏪</div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-lg font-bold text-slate-900">Tesco Express Camden</h3>
                                        <span class="px-2 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded">GOLD</span>
                                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded">ACTIVE</span>
                                    </div>
                                    <p class="text-sm text-slate-500">Convenience Store • CUST-001 • Since 2023</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-3 gap-4 mb-4">
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-xs text-slate-500 uppercase font-medium mb-1">Monthly Average</p>
                                <p class="text-lg font-bold text-slate-900">£12,450</p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-xs text-slate-500 uppercase font-medium mb-1">Order Frequency</p>
                                <p class="text-lg font-bold text-slate-900">3x / Week</p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-xs text-slate-500 uppercase font-medium mb-1">Last Order</p>
                                <p class="text-lg font-bold text-slate-900">Today</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4 text-sm">
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Contact:</span>
                                <span class="text-slate-900 font-medium">Ahmed Hassan</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Phone:</span>
                                <span class="text-slate-900 font-medium">020 7123 4567</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Address:</span>
                                <span class="text-slate-900 font-medium">123 Camden High St, NW1 0AA</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-72 space-y-3">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <p class="text-xs font-bold text-slate-500 uppercase mb-3">Delivery Schedule</p>
                            <div class="flex gap-2 flex-wrap">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-bold">Mon</span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-bold">Wed</span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-bold">Fri</span>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <p class="text-xs font-bold text-slate-500 uppercase mb-2">Preferred Items</p>
                            <div class="flex gap-2 flex-wrap">
                                <span class="text-xs text-slate-600">🥛 Milk</span>
                                <span class="text-xs text-slate-600">🥚 Eggs</span>
                                <span class="text-xs text-slate-600">🍞 Bread</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-sm font-semibold text-white transition">View Profile</button>
                            <button class="flex-1 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg text-sm font-semibold transition">Quick Order</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            @foreach($customers as $customer)
            <div 
                class="card p-6 customer-tier-gold"

                data-name="{{ strtolower($customer->business_name) }}"
                data-contact="{{ strtolower($customer->primary_contact_name) }}"
                data-address="{{ strtolower($customer->delivery_address) }}"
                
                data-tier="gold"
                data-status="{{ strtolower($customer->status) }}"
            >

                <div class="flex flex-col lg:flex-row gap-6 justify-between">

                    <!-- LEFT -->
                    <div class="flex-1">

                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">

                                <!-- Icon -->
                                <div class="w-14 h-14 rounded-full bg-amber-100 flex items-center justify-center text-2xl border-2 border-amber-200">
                                    🏪
                                </div>

                                <div>
                                    <div class="flex items-center gap-3 mb-1">

                                        <h3 class="text-lg font-bold text-slate-900">
                                            {{ $customer->business_name }}
                                        </h3>

                                        <span class="px-2 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded">
                                            GOLD
                                        </span>

                                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded">
                                            {{ strtoupper($customer->status) }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-slate-500">
                                        {{ $customer->business_type }} • 
                                        CUST-{{ str_pad($customer->id, 3, '0', STR_PAD_LEFT) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- STATS (STATIC FOR NOW) -->
                        <div class="grid md:grid-cols-3 gap-4 mb-4">
                            <div class="p-3 bg-slate-50 rounded-lg border">
                                <p class="text-xs text-slate-500 uppercase">Monthly Average</p>
                                <p class="text-lg font-bold">--</p>
                            </div>

                            <div class="p-3 bg-slate-50 rounded-lg border">
                                <p class="text-xs text-slate-500 uppercase">Order Frequency</p>
                                <p class="text-lg font-bold">--</p>
                            </div>

                            <div class="p-3 bg-slate-50 rounded-lg border">
                                <p class="text-xs text-slate-500 uppercase">Last Order</p>
                                <p class="text-lg font-bold">--</p>
                            </div>
                        </div>

                        <!-- INFO -->
                        <div class="flex flex-wrap gap-4 text-sm">
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Contact:</span>
                                <span class="font-medium">{{ $customer->primary_contact_name }}</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Phone:</span>
                                <span class="font-medium">{{ $customer->phone }}</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Address:</span>
                                <span class="font-medium">{{ $customer->delivery_address }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT -->
                    <div class="lg:w-72 space-y-3">

                        <!-- DELIVERY DAYS -->
                        <div class="p-4 bg-slate-50 rounded-xl border">
                            <p class="text-xs font-bold text-slate-500 uppercase mb-3">
                                Delivery Schedule
                            </p>

                            <div class="flex gap-2 flex-wrap">
                                @foreach($customer->preferred_delivery_days ?? [] as $day)
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-bold">
                                        {{ $day }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- ACTIONS -->
                        {{-- <div class="flex gap-2">
                            <button class="flex-1 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold">
                                View Profile
                            </button>

                            <button class="flex-1 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-semibold">
                                Quick Order
                            </button>
                        </div> --}}
                    </div>

                </div>
            </div>
            @endforeach

            <!-- Customer 2: Silver Tier - Churn Risk -->
            {{-- <div class="card p-6 customer-tier-silver">
                <div class="flex flex-col lg:flex-row gap-6 justify-between">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-2xl border-2 border-blue-200">🏪</div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-lg font-bold text-slate-900">Sainsbury's Local Islington</h3>
                                        <span class="px-2 py-1 bg-slate-200 text-slate-700 text-xs font-bold rounded">SILVER</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded">CHURN RISK</span>
                                    </div>
                                    <p class="text-sm text-slate-500">Supermarket Local • CUST-002 • Since 2022</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-3 gap-4 mb-4">
                            <div class="p-3 bg-red-50 rounded-lg border border-red-200">
                                <p class="text-xs text-red-600 uppercase font-medium mb-1">Monthly Drop</p>
                                <p class="text-lg font-bold text-red-600">-45% vs Avg</p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-xs text-slate-500 uppercase font-medium mb-1">Historical Avg</p>
                                <p class="text-lg font-bold text-slate-900">£8,200</p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-xs text-slate-500 uppercase font-medium mb-1">Last Order</p>
                                <p class="text-lg font-bold text-red-600">14 days ago</p>
                            </div>
                        </div>

                        <div class="p-3 bg-red-50 rounded-lg border border-red-200 mb-4">
                            <p class="text-xs text-red-600 font-bold uppercase mb-1">⚠️ Alert</p>
                            <p class="text-sm text-slate-600">No orders in 14 days. Previous pattern: 2x/week. Recommend: Sales outreach.</p>
                        </div>

                        <div class="flex flex-wrap gap-4 text-sm">
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Contact:</span>
                                <span class="text-slate-900 font-medium">Sarah Johnson</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Phone:</span>
                                <span class="text-slate-900 font-medium">020 7456 7890</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-72 space-y-3">
                        <div class="p-4 bg-red-50 rounded-xl border border-red-200">
                            <p class="text-xs font-bold text-red-600 uppercase mb-2">Action Required</p>
                            <button class="w-full py-2 bg-red-600 hover:bg-red-500 rounded-lg text-sm font-semibold text-white transition">Schedule Call</button>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-sm font-semibold text-white transition">View History</button>
                            <button class="flex-1 py-2 bg-emerald-600 hover:bg-emerald-500 rounded-lg text-sm font-semibold text-white transition">Send Offer</button>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Customer 3: Bronze Tier - New -->
            {{-- <div class="card p-6 customer-tier-bronze">
                <div class="flex flex-col lg:flex-row gap-6 justify-between">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center text-2xl border-2 border-orange-200">🏪</div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-lg font-bold text-slate-900">Costcutter Hackney</h3>
                                        <span class="px-2 py-1 bg-orange-100 text-orange-700 text-xs font-bold rounded">BRONZE</span>
                                        <span class="px-2 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded">PENDING</span>
                                    </div>
                                    <p class="text-sm text-slate-500">Convenience Store • CUST-089 • New Application</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-3 gap-4 mb-4">
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-xs text-slate-500 uppercase font-medium mb-1">Est. Monthly</p>
                                <p class="text-lg font-bold text-slate-900">£2,500</p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-xs text-slate-500 uppercase font-medium mb-1">Credit Check</p>
                                <p class="text-lg font-bold text-amber-600">Pending</p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-xs text-slate-500 uppercase font-medium mb-1">Applied</p>
                                <p class="text-lg font-bold text-slate-900">2 days ago</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4 text-sm">
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Contact:</span>
                                <span class="text-slate-900 font-medium">Raj Patel</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">Phone:</span>
                                <span class="text-slate-900 font-medium">020 8989 1234</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-72 space-y-3">
                        <div class="p-4 bg-amber-50 rounded-xl border border-amber-200">
                            <p class="text-xs font-bold text-amber-600 uppercase mb-2">Setup Required</p>
                            <div class="space-y-2">
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-600">Credit Check</span>
                                    <span class="text-amber-600 font-medium">⏳ Pending</span>
                                </div>
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-600">Portal Setup</span>
                                    <span class="text-slate-400">○ Not Started</span>
                                </div>
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-600">First Delivery</span>
                                    <span class="text-slate-400">○ Scheduled</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 py-2 bg-emerald-600 hover:bg-emerald-500 rounded-lg text-sm font-semibold text-white transition">Approve</button>
                            <button class="flex-1 py-2 bg-red-50 text-red-600 border border-red-200 hover:bg-red-100 rounded-lg text-sm font-semibold transition">Reject</button>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>

        <!-- Add Customer Modal -->
        <div id="add-customer-modal" class="hidden fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl p-8 max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-slate-200 shadow-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-900">Register New B2B Customer</h2>
                    <button onclick="document.getElementById('add-customer-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
                </div>
                
                <form action="{{ route('register-customer') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Business Name</label>
                        <input type="text" name="business_name" class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="e.g., Premier Convenience Store">
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Business Type</label>
                            <select name="business_type" class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none">
                                <option value="convenience_store">Convenience Store</option>
                                <option value="supermarket">Supermarket</option>
                                <option value="restaurant">Restaurant</option>
                                <option value="cafe">Cafe</option>
                                <option value="hotel">Hotel</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Estimated Monthly Volume (£)</label>
                            <input type="number" name="monthly_volume" class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="5000">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Delivery Address</label>
                        <textarea name="delivery_address" class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" rows="2" placeholder="Full address including postcode"></textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Primary Contact</label>
                            <input type="text" name="primary_contact_name" class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Full Name">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Phone Number</label>
                            <input type="text" name="phone" class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="020 0000 0000">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Email Address</label>
                        <input type="email" name="email" class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="orders@business.com">
                    </div>


                    {{-- <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Preferred Delivery Days</label>
                        <div class="flex gap-2 flex-wrap">
                            <label class="flex items-center gap-2 px-4 py-2 bg-slate-100 rounded-lg cursor-pointer hover:bg-slate-200 transition">
                                <input type="checkbox" class="rounded bg-white border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700">Mon</span>
                            </label>
                            <label class="flex items-center gap-2 px-4 py-2 bg-slate-100 rounded-lg cursor-pointer hover:bg-slate-200 transition">
                                <input type="checkbox" class="rounded bg-white border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700">Tue</span>
                            </label>
                            <label class="flex items-center gap-2 px-4 py-2 bg-slate-100 rounded-lg cursor-pointer hover:bg-slate-200 transition">
                                <input type="checkbox" class="rounded bg-white border-slate-300 text-blue-600 focus:ring-blue-500" checked>
                                <span class="text-sm text-slate-700">Wed</span>
                            </label>
                            <label class="flex items-center gap-2 px-4 py-2 bg-slate-100 rounded-lg cursor-pointer hover:bg-slate-200 transition">
                                <input type="checkbox" class="rounded bg-white border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700">Thu</span>
                            </label>
                            <label class="flex items-center gap-2 px-4 py-2 bg-slate-100 rounded-lg cursor-pointer hover:bg-slate-200 transition">
                                <input type="checkbox" class="rounded bg-white border-slate-300 text-blue-600 focus:ring-blue-500" checked>
                                <span class="text-sm text-slate-700">Fri</span>
                            </label>
                            <label class="flex items-center gap-2 px-4 py-2 bg-slate-100 rounded-lg cursor-pointer hover:bg-slate-200 transition">
                                <input type="checkbox" class="rounded bg-white border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700">Sat</span>
                            </label>
                        </div>
                    </div> --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">
                            Preferred Delivery Days
                        </label>

                        <div class="flex gap-2 flex-wrap">
                            @foreach(['Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
                                <label class="flex items-center gap-2 px-4 py-2 bg-slate-100 rounded-lg cursor-pointer hover:bg-slate-200 transition">
                                    
                                    <input 
                                        type="checkbox"
                                        name="preferred_delivery_days[]"
                                        value="{{ $day }}"
                                        class="rounded bg-white border-slate-300 text-blue-600 focus:ring-blue-500"
                                    >

                                    <span class="text-sm text-slate-700">
                                        {{ $day }}
                                    </span>

                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="button" onclick="document.getElementById('add-customer-modal').classList.add('hidden')" class="flex-1 py-3 border border-slate-300 rounded-lg text-slate-700 font-semibold hover:bg-slate-100 transition">Cancel</button>
                        <button type="submit" class="flex-1 py-3 bg-blue-600 rounded-lg text-white font-semibold hover:bg-blue-500 transition">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const search = document.getElementById("customerSearch");
    const tier = document.getElementById("tierFilter");
    const status = document.getElementById("statusFilter");

    const cards = document.querySelectorAll("[data-name]");

    function filterCustomers() {
        const searchVal = search.value.toLowerCase();
        const tierVal = tier.value;
        const statusVal = status.value;

        cards.forEach(card => {
            const name = card.dataset.name || '';
            const contact = card.dataset.contact || '';
            const address = card.dataset.address || '';
            const cardTier = card.dataset.tier || '';
            const cardStatus = card.dataset.status || '';

            let matchSearch =
                name.includes(searchVal) ||
                contact.includes(searchVal) ||
                address.includes(searchVal);

            let matchTier = !tierVal || cardTier === tierVal;
            let matchStatus = !statusVal || cardStatus === statusVal;

            if (matchSearch && matchTier && matchStatus) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    search.addEventListener("input", filterCustomers);
    tier.addEventListener("change", filterCustomers);
    status.addEventListener("change", filterCustomers);

});
</script>
</body>
</html>