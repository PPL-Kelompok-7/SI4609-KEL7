<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">

        <!-- Grup kiri: Logo + Menu -->
        <div class="d-flex align-items-center left-navbar-group">
            <!-- Logo -->
            <a class="navbar-brand me-4" href="#">
                <img src="{{ asset('images/EDUVOL LOGO 1.png') }}" alt="Logo" class="logo">
            </a>

            <!-- Menu -->
            <div class="collapse navbar-collapse show" id="navbarNav">
                <ul class="navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Partner Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Relawan Kami</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Grup kanan: Sign Up -->
        <div>
            <a href="{{ route('login') }}" class="btn signup-button">Sign Up/Log In</a>
        </div>
    </div>
</nav>
