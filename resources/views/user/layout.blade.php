<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Yonsei')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            transition: background-color 0.3s, color 0.3s;
        }
        .navbar {
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        footer {
            font-size: 14px;
        }

        /* ================= DARK MODE ================= */
        body.dark-mode {
            background-color: #121212;
            color: #e4e4e4;
        }
        body.dark-mode .navbar {
            background-color: #195087ff !important;
            box-shadow: 0 2px 6px rgba(255,255,255,0.1);
        }
        body.dark-mode footer {
            background-color: #195087ff !important;
            color: #e4e4e4;
        }
        body.dark-mode .card {
            background-color: #1e1e1e;
            color: #e4e4e4;
            border: 1px solid #2c2c2c;
        }
        body.dark-mode .card-title,
        body.dark-mode .card-text,
        body.dark-mode p,
        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4,
        body.dark-mode h5,
        body.dark-mode h6 {
            color: #e4e4e4 !important;
        }
        body.dark-mode a {
            color: #9ecbff;
        }
        body.dark-mode a:hover {
            color: #cce5ff;
        }

        /* Footer Social Media */
        footer a {
            color: #fff;
            transition: color 0.3s;
            margin: 0 5px;
        }
        footer a:hover {
            color: #ffcc00;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #195087ff;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-camera-fill"></i> YONSEI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tentang') ? 'active fw-bold' : '' }}" href="{{ route('tentang') }}">
                            <i class="bi bi-info-circle"></i> Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('galeri') ? 'active fw-bold' : '' }}" href="{{ route('galeri') }}">
                            <i class="bi bi-images"></i> Galeri
                        </a>
                    </li>
                    <!-- 🔹 Tambahan menu Agenda -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('agenda.index') ? 'active fw-bold' : '' }}" href="{{ route('agenda.index') }}">
                            <i class="bi bi-calendar-event"></i> Agenda
                        </a>
                    </li>
                    <li class="nav-item ms-3">
                        <button id="darkModeToggle" class="btn btn-sm btn-light">
                            <i class="bi bi-moon-stars"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-3 mt-4" style="background-color: #195087;">
        © 2025 <strong>YONSEI</strong>. All rights reserved.
        <div class="mt-2">
            <a href="https://youtube.com/@ysuniversity?si=g4KsNH4cDN4PBnRf" target="_blank" class="fs-5">
                <i class="bi bi-youtube"></i>
            </a>
            <a href="https://www.instagram.com/yonsei_official?igsh=MWwxdzRmbnQzY2dseQ==" target="_blank" class="fs-5">
                <i class="bi bi-instagram"></i>
            </a>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dark Mode Script -->
    <script>
        const toggleBtn = document.getElementById('darkModeToggle');
        const body = document.body;
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            toggleBtn.innerHTML = '<i class="bi bi-sun"></i>';
            toggleBtn.classList.remove('btn-light');
            toggleBtn.classList.add('btn-warning');
        }
        toggleBtn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                toggleBtn.innerHTML = '<i class="bi bi-sun"></i>';
                toggleBtn.classList.remove('btn-light');
                toggleBtn.classList.add('btn-warning');
            } else {
                localStorage.setItem('darkMode', 'disabled');
                toggleBtn.innerHTML = '<i class="bi bi-moon-stars"></i>';
                toggleBtn.classList.remove('btn-warning');
                toggleBtn.classList.add('btn-light');
            }
        });
    </script>
</body>
</html>
