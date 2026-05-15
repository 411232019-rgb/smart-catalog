<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart-Catalog')</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --grad-start:   #f7374f;
            --grad-end:     #88304e;
            --grad-mid:     #c2185b;
            --sidebar-bg:   #1a1a2e;
            --sidebar-item: #16213e;
            --sidebar-text: #8b9cbf;
            --sidebar-active: #e94560;
            --body-bg:      #f4f6fb;
            --card-radius:  16px;
            --sidebar-w:    240px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--body-bg);
            margin: 0;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sc-sidebar {
            width: var(--sidebar-w);
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sc-sidebar::-webkit-scrollbar { width: 4px; }
        .sc-sidebar::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }

        .sc-brand {
            padding: 22px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .sc-brand .brand-logo {
            font-size: 1.4rem;
            font-weight: 800;
            background: linear-gradient(90deg, var(--grad-start), var(--grad-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .sc-brand .brand-sub {
            font-size: 0.7rem;
            color: var(--sidebar-text);
            margin-top: 2px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .sc-nav { padding: 12px 0; flex: 1; }

        .sc-nav-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #4a5568;
            padding: 16px 20px 8px;
        }

        .sc-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.2s;
            position: relative;
            margin: 1px 8px;
            border-radius: 8px;
        }

        .sc-nav-link i {
            width: 20px;
            text-align: center;
            font-size: 0.9rem;
        }

        .sc-nav-link:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }

        .sc-nav-link.active {
            background: linear-gradient(90deg, rgba(233,69,96,0.25), rgba(233,69,96,0.05));
            color: #fff;
        }

        .sc-nav-link.active::before {
            content: '';
            position: absolute;
            left: -8px; top: 50%;
            transform: translateY(-50%);
            width: 4px; height: 60%;
            background: var(--sidebar-active);
            border-radius: 0 4px 4px 0;
        }

        .sc-nav-link.active i { color: var(--sidebar-active); }

        .sc-nav-link.text-danger { color: #e94560 !important; }
        .sc-nav-link.text-danger:hover { background: rgba(233,69,96,0.15); }

        /* ===== MAIN WRAPPER ===== */
        .sc-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOPBAR ===== */
        .sc-topbar {
            height: 64px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            border-bottom: 1px solid #eef0f4;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .sc-topbar .page-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a2e;
        }

        .sc-topbar .search-bar {
            background: #f4f6fb;
            border: 1px solid #e8ebf0;
            border-radius: 25px;
            padding: 7px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 220px;
        }

        .sc-topbar .search-bar input {
            border: none;
            background: none;
            outline: none;
            font-size: 0.85rem;
            color: #6b7280;
            width: 100%;
        }

        .sc-topbar .search-bar i { color: #9ca3af; font-size: 0.8rem; }

        .sc-topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sc-topbar-btn {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: #f4f6fb;
            border: 1px solid #e8ebf0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            font-size: 0.85rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sc-topbar-btn:hover { background: #eef0f4; color: #1a1a2e; }

        .sc-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--grad-start), var(--grad-end));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
        }

        /* ===== CONTENT ===== */
        .sc-content {
            flex: 1;
            padding: 28px;
        }

        /* ===== CARDS ===== */
        .sc-card {
            background: #fff;
            border-radius: var(--card-radius);
            border: none;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        .sc-card-header {
            padding: 18px 22px 14px;
            border-bottom: 1px solid #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sc-card-header h6 {
            font-size: 0.9rem;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: #fff;
            border-radius: var(--card-radius);
            padding: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        .stat-card .stat-icon {
            width: 52px; height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stat-card .stat-label {
            font-size: 0.78rem;
            color: #9ca3af;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-card .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1;
        }

        /* ===== WELCOME BANNER ===== */
        .welcome-banner {
            background: linear-gradient(135deg, var(--grad-start) 0%, var(--grad-mid) 50%, var(--grad-end) 100%);
            border-radius: var(--card-radius);
            padding: 28px 32px;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            right: -40px; top: -40px;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            right: 60px; top: 40px;
            width: 100px; height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        /* ===== TABLE ===== */
        .sc-table { color: #374151; }
        .sc-table thead th {
            border-bottom: 2px solid #f0f2f5;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9ca3af;
            padding: 14px 16px;
            background: #fafbfc;
        }
        .sc-table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f5f7fa;
            font-size: 0.875rem;
        }
        .sc-table tbody tr:hover { background: #fafbfd; }
        .sc-table tbody tr:last-child td { border-bottom: none; }

        /* ===== ALERTS ===== */
        .sc-alert {
            border-radius: 10px;
            border: none;
            padding: 12px 18px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        /* ===== FOOTER ===== */
        .sc-footer {
            background: #fff;
            border-top: 1px solid #eef0f4;
            padding: 16px 28px;
            font-size: 0.8rem;
            color: #9ca3af;
            display: flex;
            justify-content: space-between;
        }

        /* ===== BUTTONS ===== */
        .btn-gradient {
            background: linear-gradient(90deg, var(--grad-start), var(--grad-end));
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .btn-gradient:hover { 
            background: linear-gradient(90deg, #d63649, #722040);
            color: white;
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--grad-start), var(--grad-end)) !important;
            border: none !important;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #d63649, #722040) !important;
        }

        .badge-pending  { background: #fef3cd; color: #d97706; font-weight: 600; }
        .badge-diproses { background: #dbeafe; color: #2563eb; font-weight: 600; }
        .badge-selesai  { background: #d1fae5; color: #059669; font-weight: 600; }

        /* Form Controls */
        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            padding: 10px 14px;
            font-size: 0.875rem;
            transition: border-color 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--grad-start);
            box-shadow: 0 0 0 3px rgba(247,55,79,0.1);
        }

        /* Pagination */
        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            border: 1.5px solid #e5e7eb;
            color: #6b7280;
            font-size: 0.85rem;
        }
        .pagination .page-item.active .page-link {
            background: linear-gradient(90deg, var(--grad-start), var(--grad-end));
            border-color: transparent;
        }
    </style>
    @stack('css')
</head>
<body>

    <!-- ===== SIDEBAR ===== -->
    <aside class="sc-sidebar">
        <div class="sc-brand">
            <div class="brand-logo"><i class="fas fa-store me-2"></i>Smart-Catalog</div>
            <div class="brand-sub">UMKM Platform</div>
        </div>

        @include('layouts.sidebar')
    </aside>

    <!-- ===== MAIN WRAPPER ===== -->
    <div class="sc-wrapper">

        <!-- TOPBAR -->
        <header class="sc-topbar">
            <div class="page-title">@yield('page_title', 'Dashboard')</div>

            <div class="sc-topbar-right">
                <div class="search-bar d-none d-md-flex">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search..">
                </div>

                <div class="dropdown">
                    <div class="sc-avatar dropdown-toggle" data-bs-toggle="dropdown" style="list-style:none; cursor:pointer;">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="border-radius:12px; font-size:0.875rem;">
                        <li><span class="dropdown-item-text fw-bold text-dark" style="padding: 10px 16px;">{{ Auth::user()->name ?? 'Admin' }}</span></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li><a class="dropdown-item py-2" href="{{ route('profile.index') }}"><i class="fas fa-user-cog me-2 text-muted"></i> Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="sc-content">
            @if(session('success'))
                <div class="alert sc-alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert sc-alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="sc-footer">
            <span>Copyright &copy; {{ date('Y') }} <strong>Smart-Catalog</strong>. All rights reserved.</span>
            <span>Platform Katalog UMKM Modern</span>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
