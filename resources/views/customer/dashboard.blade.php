<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --navy: #0f172a;
            --royal: #1e40af;
            --gold: #d4af37;
            --emerald: #059669;
            --slate: #64748b;
            --crimson: #dc2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            z-index: 50;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .sidebar-brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
        }

        .sidebar-brand-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--royal), #3b82f6);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-brand-title {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.01em;
        }

        .sidebar-brand-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.35);
            padding-left: 42px;
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.28);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 10px 8px 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: #fff;
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 2px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #fff;
        }

        .nav-link.active {
            background: rgba(30, 64, 175, 0.45);
            color: #fff;
        }

        .nav-link .nav-icon {
            width: 18px;
            height: 18px;
            opacity: 0.65;
            flex-shrink: 0;
        }

        .nav-link.active .nav-icon {
            opacity: 1;
        }

        .sidebar-footer {
            padding: 14px 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .sidebar-user:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--royal), #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .user-info-name {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
        }

        .user-info-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.3);
            margin-top: 1px;
        }

        /* ── Topbar ── */
        .topbar {
            position: fixed;
            top: 0;
            left: 240px;
            right: 0;
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 40;
        }

        .topbar-left h1 {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
        }

        .topbar-left p {
            font-size: 12px;
            color: var(--slate);
            margin-top: 1px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-notif-btn {
            position: relative;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .topbar-notif-btn:hover {
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .notif-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: var(--crimson);
            border-radius: 50%;
            border: 1.5px solid #fff;
        }

        .topbar-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--royal), #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
        }

        /* ── Main Content ── */
        .main-content {
            margin-left: 240px;
            margin-top: 64px;
            padding: 28px;
            min-height: calc(100vh - 64px);
        }

        /* ── Shared Card ── */
        .card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
        }

        /* ── Status Pills ── */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .pill-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        .pill-green {
            background: #d1fae5;
            color: #065f46;
        }

        .pill-amber {
            background: #fef3c7;
            color: #92400e;
        }

        .pill-blue {
            background: #dbeafe;
            color: #1e40af;
        }

        .pill-red {
            background: #fee2e2;
            color: #991b1b;
        }

        .pill-purple {
            background: #ede9fe;
            color: #5b21b6;
        }

        /* ── Stat Card ── */
        .stat-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            padding: 18px 20px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--slate);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1;
        }

        .stat-trend {
            font-size: 11px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trend-up {
            color: var(--emerald);
        }

        .trend-down {
            color: var(--crimson);
        }

        /* ── Table ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead th {
            text-align: left;
            padding: 12px 16px;
            font-size: 11px;
            font-weight: 700;
            color: var(--slate);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table thead th:first-child {
            border-radius: 0;
        }

        .data-table tbody td {
            padding: 13px 16px;
            font-size: 13px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .data-table tbody tr {
            transition: background 0.15s;
        }

        .data-table tbody tr:hover td {
            background: #f8fafc;
        }

        /* ── Sea Section ── */
        .sea-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
            border-radius: 14px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .sea-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .sea-card-item {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 14px;
            transition: all 0.25s ease;
        }

        .sea-card-item:hover {
            background: rgba(255, 255, 255, 0.11);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .eta-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-radius: 5px;
            padding: 2px 8px;
            font-size: 10px;
            font-weight: 700;
            color: #fff;
        }

        /* ── Responsive ── */
        @media(max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .topbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        .logout-btn {
            width: 100%;
            margin-top: 12px;
            padding: 10px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
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
    </style>
</head>

<body>

    {{-- ══ SIDEBAR ══ --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-logo">
                <div class="sidebar-brand-icon">
                    <svg width="16" height="16" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <span class="sidebar-brand-title">Customer Panel</span>
            </div>
            <div class="sidebar-brand-sub">Manage your account</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main</div>

            <a href="/customer/dashboard" class="nav-link {{ Request::is('customer/dashboard') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dashboard
            </a>

            <a href="/main" class="nav-link {{ Request::is('main') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Home
            </a>

            <a href="/customer/profile" class="nav-link {{ Request::is('customer/profile') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
                My Profile
            </a>

            <div class="nav-section-label" style="margin-top:8px;">Activity</div>

            <a href="/customer/orders"
                class="nav-link {{ Request::is('customer/orders*') || Request::is('order/*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 7H4a1 1 0 00-1 1v10a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1z" />
                    <path d="M16 3H8l-1 4h10z" />
                </svg>
                My Orders
            </a>

            <a href="/customer/payments" class="nav-link {{ Request::is('customer/payments') ||  Request::is('invoice/*')   ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="2" y="5" width="20" height="14" rx="2" />
                    <path d="M2 10h20" />
                </svg>
                Payment History
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                <div>
                    <div class="user-info-name">{{ Auth::user()->name }}</div>
                    <div class="user-info-role">{{ ucfirst(Auth::user()->role) }}</div>
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

    {{-- ══ TOPBAR ══ --}}
    <header class="topbar">
        <div class="topbar-left">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <p>@yield('page-subtitle', 'Welcome back, ' . Auth::user()->name)</p>
        </div>
        <div class="topbar-actions">
            <div class="topbar-notif-btn">
                <svg width="16" height="16" fill="none" stroke="#64748b" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M18 8a6 6 0 10-12 0c0 7-3 9-3 9h18s-3-2-3-9" />
                    <path d="M13.73 21a2 2 0 01-3.46 0" />
                </svg>
                <span class="notif-badge"></span>
            </div>
            <div class="topbar-avatar" title="{{ Auth::user()->name }}">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
        </div>
    </header>

    

    {{-- ══ MAIN CONTENT ══ --}}
    <main class="main-content">
        @yield('content')
    </main>
    <script>
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '/';
            }
        }
    </script>

</body>

</html>