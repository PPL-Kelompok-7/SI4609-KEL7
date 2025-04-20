app.blade.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edu Volunteer</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome CSS (ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    <!-- NAVBAR: Kode header sama persis seperti sebelumnya -->
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Logo Kiri -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('logo0.png') }}" alt="Logo EduVolunteer">
            </a>

            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item mx-3"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item mx-3"><a class="nav-link" href="#">Agenda</a></li>
                    <li class="nav-item mx-3"><a class="nav-link" href="#">Partner Kami</a></li>
                    <li class="nav-item mx-3"><a class="nav-link" href="#">Relawan Kami</a></li>
                </ul>
            </div>

            <!-- Icon dan Profil Kanan -->
            <div class="d-flex align-items-center">
                <a href="#" class="nav-link text-white me-3">
                    <i class="fas fa-list fa-lg"></i>
                </a>
                <a href="#" class="nav-link text-white me-3">
                    <i class="fas fa-bell fa-lg"></i>
                </a>
                <img src="{{ asset('profile.png') }}" alt="Foto Profil"
                     class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                <a href="#" class="nav-link text-success fw-semibold">Profil</a>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->

    <!-- MAIN CONTENT -->
    <div class="container-fluid py-4">
        @yield('content')
    </div>
    <!-- END MAIN CONTENT -->

    <!-- FOOTER -->
<footer class="footer-navbar">
    <img src="{{ asset('logo0.png') }}" alt="Logo EduVolunteer">
    
    <div class="text-center">
        <div>
            <i class="fas fa-map-marker-alt me-2"></i>Bandung, Jawa Barat
        </div>
        <div>
            <i class="fas fa-phone me-2"></i>0821-1234-5678
        </div>
    </div>

    <button class="btn">
        <i class="fas fa-play me-2"></i> Mulai Perjalanan
    </button>
</footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

