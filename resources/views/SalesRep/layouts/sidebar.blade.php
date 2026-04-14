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
                    <a href="/sales" class="nav-item {{ request()->is('sales') ? 'active' : '' }}" aria-current="page">
                        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                        <span class="nav-text">Dashboard</span>
                        <span class="tooltip">Dashboard</span>
                    </a>
                    <a href="/sales-customers" class="nav-item {{ request()->is('sales-customers') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        <span class="nav-text">My Customers</span>
                        <span class="nav-badge">3</span>
                        <span class="tooltip">My Customers</span>
                    </a>
                    <a href="/sales-orders2" class="nav-item {{ request()->is('sales-orders') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                        <span class="nav-text">All Orders</span>
                        <span class="tooltip">All Orders</span>
                    </a>
                    <a href="/sales-tasks" class="nav-item {{ request()->is('sales-tasks') ? 'active' : '' }}">
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
                    <a href="/sales-performance" class="nav-item {{ request()->is('sales-performance') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
                        <span class="nav-text">Performance</span>
                        <span class="tooltip">Performance</span>
                    </a>
                    <a href="/sales-commissions" class="nav-item {{ request()->is('sales-commissions') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-pound-sign"></i></span>
                        <span class="nav-text">Commissions</span>
                        <span class="tooltip">Commissions</span>
                    </a>
                    <a href="/sales-target" class="nav-item {{ request()->is('sales-target') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-bullseye"></i></span>
                        <span class="nav-text">Targets</span>
                        <span class="tooltip">Targets</span>
                    </a>
                </div>
            </div>

            <!-- Tools Section -->
            {{-- <div class="menu-section" id="section-tools">
                <div class="section-header" onclick="toggleSection('section-tools')" tabindex="0" role="button" aria-expanded="true">
                    <span class="section-label">Tools</span>
                    <i class="fas fa-chevron-down section-chevron"></i>
                </div>
                <div class="section-content">
                    <a href="sales_price_lists.html" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-file-invoice"></i></span>
                        <span class="nav-text">Price Lists</span>
                        <span class="tooltip">Price Lists</span>
                    </a>
                    <a href="sales_catalog.html" class="nav-item">
                        <span class="nav-icon"><i class="fas fa-box-open"></i></span>
                        <span class="nav-text">Product Catalog</span>
                        <span class="tooltip">Product Catalog</span>
                    </a>
                </div>
            </div> --}}
        </nav>

        <!-- Footer -->
        <div class="sidebar-footer">
            <div class="user-profile" onclick="openProfile()" title="View Profile">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" alt="Mike Thompson" class="user-avatar">
                <div class="user-info">
                    <p class="user-name">{{Auth::user()->name}}</p>
                    <p class="user-role">{{Auth::user()->role}}</p>
                </div>
            </div>
            <form method="POST" action="{{ url('/logout') }}">
                 @csrf
            {{-- <button class="logout-btn" onclick="logout()" aria-label="Logout"> --}}
            <button type="submit" class="logout-btn" aria-label="Logout">

                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
            </form>
        </div>
    </aside>