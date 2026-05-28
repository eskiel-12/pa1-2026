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
            background: linear-gradient(180deg, #e2e8f0 0%, #f8fafc 100%);
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100%;
            background: #1e293b;
            color: #94a3b8;
            transition: transform 0.3s ease;
            z-index: 1000;
            transform: translateX(-90%);
        }
        
        .sidebar.open {
            transform: translateX(0);
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #334155;
        }
        
        .sidebar-header h4 {
            color: white;
            font-size: 1.2rem;
            margin: 0;
        }
        
        .sidebar-header h4 span {
            color: #3b82f6;
        }
        
        .sidebar-menu {
            padding: 15px 0;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #94a3b8;
            text-decoration: none;
            transition: 0.2s;
        }
        
        .sidebar-menu a i {
            width: 25px;
            margin-right: 10px;
        }
        
        .sidebar-menu a:hover {
            background: #334155;
            color: white;
        }
        
        .sidebar-menu a.active {
            background: #3b82f6;
            color: white;
        }
        
        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
        }
        
        .overlay.show {
            display: block;
        }
        
        /* Main Content */
        .main-content {
            padding: 18px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        
        /* Top Bar */
        .top-bar {
            background: linear-gradient(135deg, #2563eb, #0f172a);
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
            color: #f8fafc;
        }
        
        .menu-btn {
            background: #1e293b;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .page-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0;
            color: #f8fafc;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-name {
            font-size: 0.85rem;
            display: none;
        }
        
        .logout-btn {
            background: #ef4444;
            border: none;
            padding: 8px 14px;
            border-radius: 10px;
            color: white;
            font-size: 0.82rem;
            font-weight: 600;
            box-shadow: 0 5px 14px rgba(239, 68, 68, 0.25);
        }
        
        .alert-custom {
            background: #f8fafc;
            border-left: 4px solid #3b82f6;
            color: #334155;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 20px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.08);
        }
        
        .alert-custom.success {
            border-color: #10b981;
            background: #ecfdf5;
        }
        
        .alert-custom.error {
            border-color: #ef4444;
            background: #fef2f2;
        }
        
        /* Cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-left: 3px solid #3b82f6;
        }
        
        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .stat-label {
            font-size: 0.75rem;
            color: #666;
        }
        
        /* Table Card */
        .card-table {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .card-table h5 {
            font-size: 1rem;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        table {
            width: 100%;
            font-size: 0.8rem;
        }
        
        th {
            text-align: left;
            padding: 10px 0;
            color: #666;
            font-weight: 500;
            border-bottom: 1px solid #eee;
        }
        
        td {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .badge {
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.7rem;
        }
        
        .badge-success {
            background: #10b981;
            color: white;
        }
        
        .badge-danger {
            background: #ef4444;
            color: white;
        }
        
        /* Quick Actions */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .action-btn {
            flex: 1;
            background: #f1f5f9;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            font-size: 0.75rem;
        }
        
        .action-btn i {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        /* Preview Image */
        .preview-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        /* Button */
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.7rem;
            border-radius: 6px;
        }
        
        /* Responsive Tablet */
        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 260px;
                padding: 20px;
            }
            .menu-btn {
                display: none;
            }
            .user-name {
                display: inline;
            }
            .stat-card {
                margin-bottom: 0;
            }
            .stat-number {
                font-size: 2rem;
            }
        }
        
        /* Responsive Desktop */
        @media (min-width: 992px) {
            .stat-number {
                font-size: 2.2rem;
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