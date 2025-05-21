<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Saya</title>
    <link rel="stylesheet" href="{{ asset('css/posting-event.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notifikasi.css') }}">
</head>
<body>
    <div class="main-layout">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="menu" style="width: 100%; margin-top: 90px; display: flex; flex-direction: column; gap: 0.5px;">
                <a href="#" class="menu-item" style="padding: 25px 36px; font-size: 1rem; color: #fff; text-decoration: none; display: block; font-weight: 500; margin-bottom: 8px; border-radius: none; transition: background 0.2s, color 0.2s; letter-spacing: 0.5px; background: none;">Dashboard</a>
                <a href="{{ url('/posting-event') }}" class="menu-item" style="padding: 25px 36px; font-size: 1rem; color: #fff; text-decoration: none; display: block; font-weight: 500; margin-bottom: 8px; border-radius: none; transition: background 0.2s, color 0.2s; letter-spacing: 0.5px; background: none;">Event Saya</a>
                <a href="{{ url('/notifikasi') }}" class="menu-item active" style="padding: 25px 36px; font-size: 1rem; color: #fff; text-decoration: none; display: block; font-weight: 500; margin-bottom: 8px; border-radius: none; transition: background 0.2s, color 0.2s; letter-spacing: 0.5px; background: #FD01EB;">Notifikasi</a>
            </div>
        </div>
        <!-- Main Content Area -->
        <div style="flex:1;">
            <!-- Navbar Top -->
            <div class="navbar-top">
                <div class="navbar-left">
                    <img src="{{ asset('images/EDUVOL LOGO 1.png') }}" alt="EDU Volunteer" class="eduvol-logo">
                </div>
                <div class="school">
                    <div class="school-logo-circle">
                        <img src="{{ asset('images/logo-telkom-schools.png') }}" alt="SMK Telkom Bandung">
                    </div>
                    <span class="school-name">SMK Telkom Bandung</span>
                </div>
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            </div>
            <!-- Main Content (Notifikasi) -->
            <div class="main-content">
                <div class="notif-header" style="display: flex; align-items: center; gap: 12px;">
                    <img src="{{ asset('images/notifikasibel.png') }}" alt="Bell Icon" style="width: 40px; height: 40px;">
                    <span class="notif-title">Notifikasi <span>Saya</span></span>
                </div>
                <div class="notif-tabs">
                    <span class="active">Belum Dibaca</span>
                    <span>Semua</span>
                </div>
                <div class="notif-list">
                    @foreach($notifications as $notif)
                        <div class="notif-card">
                            <div class="notif-title">Pendaftaran Relawan Baru</div>
                            <div class="notif-desc">Relawan <b>{{ $notif->volunteer_name }}</b> telah mendaftar pada event <b>{{ $notif->event_title }}</b>.</div>
                            <div class="notif-meta">{{ $notif->created_at->format('d M Y') }} | {{ $notif->created_at->format('H:i') }} <a href="{{ url('/event-detail/'.$notif->event_id) }}" class="notif-detail">Lihat Detail</a></div>
                        </div>
                    @endforeach
                    @if($notifications->isEmpty())
                        <div style="color:#fff;opacity:0.7;">Belum ada notifikasi baru.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html> 