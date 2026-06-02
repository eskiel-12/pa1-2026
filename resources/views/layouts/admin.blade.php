<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #ecf0f1 0%, #f5f7fa 50%, #e9ecef 100%);
            min-height: 100vh;
            color: #2c3e50;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100%;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: #94a3b8;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            transform: translateX(-100%);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
        }
        
        .sidebar.open {
            transform: translateX(0);
        }
        
        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }
        
        .sidebar-header h4 {
            color: white;
            font-size: 1.35rem;
            margin: 0;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .sidebar-header h4 span {
            color: #3b82f6;
            font-weight: 800;
        }
        
        .sidebar-menu {
            padding: 16px 0;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 13px 20px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.25s ease;
            position: relative;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .sidebar-menu a i {
            width: 22px;
            margin-right: 12px;
            font-size: 1rem;
        }
        
        .sidebar-menu a:hover {
            background: rgba(59, 130, 246, 0.15);
            color: #e0e7ff;
            padding-left: 24px;
        }
        
        .sidebar-menu a.active {
            background: linear-gradient(90deg, #3b82f6 0%, #1e40af 100%);
            color: white;
            border-left: 4px solid #60a5fa;
            padding-left: 16px;
            box-shadow: inset 2px 0 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 999;
            display: none;
            backdrop-filter: blur(2px);
            transition: opacity 0.3s ease;
        }
        
        .overlay.show {
            display: block;
        }
        
        /* Main Content */
        .main-content {
            padding: 20px;
            min-height: 100vh;
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Top Bar */
        .top-bar {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 50%, #0f172a 100%);
            border-radius: 16px;
            padding: 16px 24px;
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 12px 32px rgba(37, 99, 235, 0.2), 0 2px 8px rgba(0, 0, 0, 0.1);
            color: #f8fafc;
            transition: all 0.3s ease;
        }
        
        .top-bar:hover {
            box-shadow: 0 16px 40px rgba(37, 99, 235, 0.25), 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }
        
        .menu-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .menu-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }
        
        .page-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
            color: #f8fafc;
            letter-spacing: -0.3px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .user-name {
            font-size: 0.9rem;
            display: none;
            font-weight: 500;
            color: #e0e7ff;
        }
        
        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            color: white;
            font-size: 0.85rem;
            font-weight: 600;
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }
        
        .logout-btn:active {
            transform: translateY(0);
        }
        
        .alert-custom {
            background: #f8fafc;
            border-left: 5px solid #3b82f6;
            color: #334155;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInDown 0.4s ease;
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .alert-custom.success {
            border-left-color: #10b981;
            background: #f0fdf4;
            color: #065f46;
        }
        
        .alert-custom.error {
            border-left-color: #ef4444;
            background: #fef2f2;
            color: #7f1d1d;
        }
        
        /* Stat Cards Grid */
        .row {
            display: grid;
            gap: 20px;
            margin-bottom: 28px;
        }
        
        .row > [class*="col-"] {
            min-width: 0;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid rgba(203, 213, 225, 0.3);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border-left: 5px solid #3b82f6;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: default;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        
        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border-color: rgba(59, 130, 246, 0.2);
        }
        
        .stat-number {
            font-size: 2.2rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 10px 0;
            letter-spacing: -1px;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Table Card */
        .card-table {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 28px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(203, 213, 225, 0.3);
            transition: all 0.3s ease;
        }
        
        .card-table:hover {
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border-color: rgba(59, 130, 246, 0.15);
        }
        
        .card-table h5 {
            font-size: 1.15rem;
            margin-bottom: 20px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-table h5::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 24px;
            background: linear-gradient(180deg, #3b82f6 0%, #1e40af 100%);
            border-radius: 2px;
        }
        
        table {
            width: 100%;
            font-size: 0.9rem;
            border-collapse: collapse;
        }
        
        thead {
            background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 2px solid #e2e8f0;
        }
        
        th {
            text-align: left;
            padding: 14px 16px;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.4px;
        }
        
        tbody tr {
            transition: all 0.25s ease;
            border-bottom: 1px solid #e2e8f0;
        }
        
        tbody tr:hover {
            background: #f8fafc;
            box-shadow: inset 0 0 8px rgba(59, 130, 246, 0.05);
        }
        
        tbody tr:last-child {
            border-bottom: none;
        }
        
        td {
            padding: 14px 16px;
            color: #475569;
            vertical-align: middle;
        }
        
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-block;
            transition: all 0.2s ease;
        }
        
        .badge-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border: 1px solid #6ee7b7;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);
        }
        
        .badge-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #7f1d1d;
            border: 1px solid #fca5a5;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.15);
        }
        
        /* Quick Actions */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }
        
        .action-btn {
            flex: 1;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            text-align: center;
            padding: 14px;
            border-radius: 12px;
            text-decoration: none;
            color: #475569;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            transition: all 0.25s ease;
            cursor: pointer;
        }
        
        .action-btn i {
            display: block;
            font-size: 1.4rem;
            margin-bottom: 8px;
            color: #3b82f6;
        }
        
        .action-btn:hover {
            background: linear-gradient(135deg, #e0e7ff 0%, #dbeafe 100%);
            color: #1e40af;
            border-color: #3b82f6;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.2);
        }
        
        .action-btn:active {
            transform: translateY(-1px);
        }
        
        /* Preview Image */
        .preview-img {
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            transition: all 0.2s ease;
        }
        
        .preview-img:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* Button */
        .btn-sm {
            padding: 8px 12px;
            font-size: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .btn-sm:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            color: white;
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.35);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.25);
        }
        
        .btn-secondary:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            color: white;
            box-shadow: 0 6px 16px rgba(107, 114, 128, 0.35);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
        }
        
        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: white;
            box-shadow: 0 6px 16px rgba(245, 158, 11, 0.35);
        }
        
        .bg-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        }
        
        .bg-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        }
        
        /* Responsive Mobile */
        @media (max-width: 767px) {
            .main-content {
                padding: 16px;
            }
            
            .top-bar {
                padding: 14px 16px;
                margin-bottom: 20px;
                border-radius: 12px;
            }
            
            .page-title {
                font-size: 1rem;
                flex: 1;
                text-align: center;
            }
            
            .user-info {
                gap: 8px;
            }
            
            .stat-card {
                padding: 18px;
                border-radius: 12px;
            }
            
            .stat-number {
                font-size: 1.8rem;
            }
            
            .card-table {
                padding: 16px;
                margin-bottom: 20px;
            }
            
            .card-table h5 {
                font-size: 1rem;
                margin-bottom: 16px;
            }
            
            table {
                font-size: 0.8rem;
            }
            
            th, td {
                padding: 10px 8px;
            }
            
            .btn-sm {
                padding: 6px 10px;
                font-size: 0.7rem;
            }
            
            .row {
                gap: 16px;
            }
        }
        
        /* Responsive Tablet */
        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 260px;
                padding: 24px;
            }
            .menu-btn {
                display: none;
            }
            .user-name {
                display: inline;
            }
            .stat-number {
                font-size: 2.2rem;
            }
        }
        
        /* Responsive Desktop */
        @media (min-width: 992px) {
            .stat-number {
                font-size: 2.4rem;
            }
            .main-content {
                padding: 28px;
            }
            .top-bar {
                padding: 18px 28px;
            }
        }
        
        /* Responsive Large Desktop */
        @media (min-width: 1200px) {
            .main-content {
                padding: 32px;
            }
            .top-bar {
                padding: 20px 32px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>Geo<span>Toba</span></h4>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="{{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Galeri
            </a>
            <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Berita
            </a>
            <a href="{{ route('admin.informasi.index') }}" class="{{ request()->routeIs('admin.informasi.*') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i> Informasi
            </a>
            <a href="{{ route('admin.banner.index') }}" class="{{ request()->routeIs('admin.banner.*') ? 'active' : '' }}">
                <i class="fas fa-image"></i> Banner
            </a>
            <a href="{{ route('admin.destinasi.index') }}" class="{{ request()->routeIs('admin.destinasi.*') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i> Destinasi
            </a>
            <a href="{{ route('admin.akomodasi.index') }}" class="{{ request()->routeIs('admin.akomodasi.*') ? 'active' : '' }}">
                <i class="fas fa-hotel"></i> Akomodasi
            </a>
            <a href="{{ route('admin.transportasi.index') }}" class="{{ request()->routeIs('admin.transportasi.*') ? 'active' : '' }}">
                <i class="fas fa-shuttle-van"></i> Transportasi
            </a>
            <a href="{{ route('admin.umkm.index') }}" class="{{ request()->routeIs('admin.umkm.*') ? 'active' : '' }}">
                <i class="fas fa-store"></i> UMKM
            </a>
            <a href="{{ route('admin.kontak.index') }}" class="{{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
                <i class="fas fa-phone"></i> Kontak
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <button class="menu-btn" id="menuBtn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <span class="page-title">@yield('title')</span>
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-custom success">{{ session('success') }}</div>
        @endif
        @if(session('status'))
            <div class="alert-custom success">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-custom error">{{ $errors->first() }}</div>
        @endif
        
        @yield('content')
    </div>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }
        
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        }
    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>