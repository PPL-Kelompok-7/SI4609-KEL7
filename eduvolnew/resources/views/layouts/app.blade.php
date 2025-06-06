<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edu Volunteer</title>
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome CSS (ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @yield('css')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        html, body {
            height: 100%;
            min-height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

        body {
            display: block !important;
            min-height: 100vh;
            height: auto !important;
        }

        .main-content {
            flex: 1;
            padding-top: 76px;
        }

        .footer-navbar {
            background-color: #0E100F;
            padding: 0.7rem 0;
            margin-top: 2rem;
            color: #FFFFFF;
        }
        
        .footer-navbar img {
            filter: brightness(0) invert(1);
            height: 32px;
            margin-bottom: 0 !important;
        }
        
        .footer-navbar .location-container {
            padding-left: 0;
            padding-right: 0;
            align-items: flex-start;
            justify-content: flex-start;
            margin: 0;
        }
        
        .footer-navbar .location-info {
            margin-bottom: 0 !important;
            margin-top: 0 !important;
        }
        
        .footer-navbar .btn-start {
            background-color: #69FD8D;
            color: #0E100F;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .footer-navbar .btn-start:hover {
            background-color: #50e974;
            transform: translateY(-2px);
        }
        
        .footer-navbar i {
            color: #FFFFFF;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 0;
            }
            .main-content {
                padding-top: 62px;
            }
            .footer-navbar .location-container {
                margin: 1rem 0;
            }
        }

        .nav-profile-photo {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .nav-profile-photo:hover {
            border-color: rgba(255, 255, 255, 0.5);
            transform: scale(1.05);
        }
        .navbar {
            background-color: #4E36E9;
            padding-top: 0.2rem !important;
            padding-bottom: 0.2rem !important;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
            min-height: 64px;
            display: flex;
            align-items: center;
        }
        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding-top: 4px !important;
            padding-bottom: 4px !important;
        }
        .navbar-nav .nav-link:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        .footer-navbar,
        .footer-navbar .location-info,
        .footer-navbar .btn-start,
        .footer-navbar span,
        .footer-navbar a {
            color: #fff !important;
        }
        .navbar .navbar-nav .nav-link,
        .navbar .navbar-brand,
        .navbar .d-flex.align-items-center {
            padding-top: 6px;
            padding-bottom: 6px;
        }
        .footer-navbar .row.align-items-center {
            align-items: flex-end !important;
        }
        .footer-navbar .location-info,
        .footer-navbar .btn-start {
            margin-top: 6px;
            margin-bottom: 6px;
        }
        .footer-navbar .location-container {
            gap: 2px !important;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo Kiri -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('logo0.png') }}" alt="Logo EduVolunteer" height="40">
            </a>

            <!-- Tombol Toggle untuk Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::routeIs('events.index') ? 'active' : '' }}" href="{{ route('events.index') }}">Agenda</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::routeIs('partners') ? 'active' : '' }}" href="{{ route('partners') }}">Partner Kami</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::routeIs('volunteers') ? 'active' : '' }}" href="{{ route('volunteers') }}">Relawan Kami</a>
                    </li>
                </ul>

                <!-- Icon dan Profil Kanan -->
                <div class="d-flex align-items-center">
                    @auth
                        <a href="{{ route('history-kegiatan.index') }}" class="nav-link text-white me-3" title="History Kegiatan">
                            <i class="fas fa-list fa-lg"></i>
                        </a>
                        <a href="{{ route('notifikasi.relawan') }}" class="nav-link text-white me-3" title="Notifikasi">
                            <i class="fas fa-bell fa-lg"></i>
                        </a>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->profile_photo && file_exists(public_path('storage/' . Auth::user()->profile_photo)) 
                                    ? Storage::url(Auth::user()->profile_photo) 
                                    : asset('profile2.png') }}" 
                                     alt="Foto Profil"
                                     class="rounded-circle nav-profile-photo me-2">
                                <span class="text-white fw-semibold">{{ Auth::user()->first_name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profil Saya</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-light">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer-navbar">
        <div class="container">
            <div class="row align-items-center" style="height: 70px;">
                <div class="col-md-4 col-lg-3 d-flex align-items-center justify-content-center h-100">
                    <img src="{{ asset('logo0.png') }}" alt="Logo EduVolunteer" style="height:40px;">
                </div>
                <div class="col-md-4 col-lg-6 d-flex align-items-center justify-content-center h-100">
                    <div class="location-container d-flex flex-column" style="gap: 2px;">
                        <div class="location-info" style="margin-bottom:0;">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Bandung, Indonesia</span>
                        </div>
                        <div class="location-info" style="margin-top:0;">
                            <i class="fas fa-phone"></i>
                            <span>0821-1234-5678</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 text-md-end text-center d-flex align-items-center justify-content-center h-100">
                    <a href="{{ route('register') }}" class="btn-start">
                        Mulai Perjalananmu
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Stack for additional scripts -->
    @stack('scripts')

    <script>
    // Global error handler
    window.onerror = function(msg, url, lineNo, columnNo, error) {
        console.error('Error: ' + msg + '\nURL: ' + url + '\nLine: ' + lineNo + '\nColumn: ' + columnNo + '\nError object: ' + JSON.stringify(error));
        return false;
    };
    </script>

</body>
</html>