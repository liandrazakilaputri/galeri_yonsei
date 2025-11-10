<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - YONSEI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            background: #f8f9fa;
        }
        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: #195087;
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
        }
        .sidebar h4 {
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: background 0.2s;
        }
        .sidebar a:hover {
            background-color: #143c64;
        }
        .sidebar a.active {
            background-color: #0f2d4a;
            font-weight: bold;
        }

        /* Konten utama */
        .content {
            margin-left: 240px;
            flex-grow: 1;
            padding: 20px 40px;
        }
        .navbar {
            background: #195087;
            color: white;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .navbar span {
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>YONSEI Admin</h4>

        <a href="{{ route('admin.dashboard') }}" 
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">🏠 Dashboard</a>

        <a href="{{ route('admin.galeri.index') }}" 
           class="{{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">🖼️ Galeri</a>

        <a href="{{ route('admin.kategori.index') }}" 
           class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">📂 Kategori</a>

        <a href="{{ route('admin.agenda.index') }}" 
           class="{{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">🗓️ Agenda</a>

        <a href="{{ route('admin.users.index') }}" 
           class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">👤 Admin</a>

        <a href="{{ route('admin.komentar.index') }}" 
           class="{{ request()->routeIs('admin.komentar.*') ? 'active' : '' }}">💬 Komentar & Rating</a>

        <a href="{{ route('logout') }}">🚪 Logout</a>
    </div>

    <!-- Konten utama -->
    <div class="content">
        <nav class="navbar shadow-sm px-3 py-2">
            <span>YONSEI - Admin Panel</span>
        </nav>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
