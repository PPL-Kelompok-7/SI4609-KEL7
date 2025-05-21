<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Event Volunteer</title>
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
</head>
<body>
    <nav class="navbar-eduv" style="background:#462FD8;display:flex;align-items:center;justify-content:space-between;padding:0 60px;height:70px;position:fixed;top:0;left:0;right:0;z-index:1000;">
        <div style="display:flex;align-items:center;gap:32px;">
            <img src="{{ asset('images/EDUVOL LOGO 1.png') }}" alt="EDU Volunteer" style="height:45px;margin-top:10px;margin: bottom 10px;">
        </div>
        <div style="display:flex;align-items:center;gap:56px;flex:1;justify-content:center;">
            <a href="#" style="color:white;text-decoration:none;font-size:15px;font-weight:bold;">Beranda</a>
            <a href="{{ url('/events') }}" style="color:#38E25D;text-decoration:none;font-size:15px;font-weight:bold;">Agenda</a>
            <a href="#" style="color:white;text-decoration:none;font-size:15px;font-weight:bold;">Partner Kami</a>
            <a href="#" style="color:white;text-decoration:none;font-size:15px;font-weight:bold;">Relawan Kami</a>
        </div>
        <div style="display:flex;align-items:center;gap:24px;">
            <img src="{{ asset('images/activity.png') }}" alt="Task" style="height:28px;">
            <img src="{{ asset('images/notification.png') }}" alt="Notifikasi" style="height:28px;">
            @auth
                <a href="{{ url('/profile') }}" style="display:flex;align-items:center;text-decoration:none;">
                    <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('profile1.png') }}" alt="Profil" style="height:38px;width:38px;border-radius:50%;object-fit:cover;border: 2px solid #4E36E9;">
                    <span style="color:white;font-size:16px;margin-left:6px;">{{ Auth::user()->first_name }}</span>
                </a>
            @else
                <img src="{{ asset('profile1.png') }}" alt="Profil" style="height:38px;width:38px;border-radius:50%;object-fit:cover;">
                <span style="color:white;font-size:16px;margin-left:6px;">Profil</span>
            @endauth
        </div>
    </nav>
    <div class="container">
        <h2 style="margin-top:65px;"><span>Menampilkan</span> <strong>Event Volunteer</strong><br>yang dapat kamu ikuti</h2>

        <div class="event-grid">
            {{-- Event Card --}}
            @foreach ($events as $event)
                <div class="card">
                    <img src="{{ !empty($event['event_photo']) ? asset('storage/' . $event['event_photo']) : asset('default-event.png') }}" alt="Event Image" class="event-image">
                    
                    <!-- Logo kecil di pojok kiri atas -->
                    <div class="logo-circle">
                        <img src="{{ asset('images/logo-telkom-schools.png') }}" alt="Logo" style="width: 30px; height: 40px;">
                    </div>

                    <div class="card-content">
                        <div class="event-action-row" style="display: flex; align-items: center; gap: 12px;">
                            <span class="event-love">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <circle cx="20" cy="20" r="20" fill="white"/>
                                    <path d="M20 30C19.47 30 18.93 29.83 18.51 29.48C15.41 26.29 8 20.91 8 15.67C8 12.24 10.91 9.33 14.33 9.33C16.16 9.33 17.89 10.24 18.83 11.73C19.77 10.24 21.5 9.33 23.33 9.33C26.75 9.33 29.66 12.24 29.66 15.67C29.66 20.91 22.25 26.29 19.15 29.48C18.73 29.83 18.19 30 17.67 30H20Z" fill="#F44336"/>
                                </svg>
                            </span>
                            <a href="{{ route('event.detail', $event['id']) }}" class="btn-partisipasi">Ikut Partisipasi</a>
                        </div>
                        <div class="card-details">
                            <h3>{{ $event['title'] }}</h3>
                            <div class="event-info">
                                <div class="info">
                                    <img src="{{ asset('images/price-tag.png') }}" alt="Price Icon">
                                    <span>{{ $event['price'] }}</span>
                                </div>
                                <div class="info">
                                    <img src="{{ asset('images/task.png') }}" alt="Task Icon">
                                    <span>{{ $event['date'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>

        <!-- <footer class="footer">
    <div class="footer-left">
        <img src="{{ asset('images/logo1.png') }}" alt="Logo EduVolunteer" class="eduv-logo">
        <div class="contact-info">
            <div class="location">
                <img src="{{ asset('images/location.png') }}" alt="Location Icon">
                Bandung, Indonesia
            </div>
            <div class="phone">
                <img src="{{ asset('images/viber.png') }}" alt="Phone Icon">
                0821-1234-5678
            </div>
        </div>
    </div>
    <button class="start-btn">
        <img src="{{ asset('images/logostart.png') }}" alt="Start Icon">
        Mulai Perjalananmu
    </button>
</footer> -->
    </div>
    <footer class="footer" style="background:#000; color:white; display:flex; justify-content:space-between; align-items:center; padding:20px 60px; position:fixed; left:0; right:0; bottom:0; z-index:1000;">
        <div style="display:flex; align-items:center; gap:16px;">
            <img src="{{ asset('images/EDUVOL LOGO 1.png') }}" alt="Logo EduVolunteer" style="height:40px;">
            <div style="margin-left:175px;">
                <div style="display:flex; align-items:center; gap:8px;">
                    <img src="{{ asset('images/locationputih.png') }}" alt="Location Icon" style="height:18px;">
                    <span>Bandung, Indonesia</span>
                </div>
                <div style="display:flex; align-items:center; gap:8px;">
                    <img src="{{ asset('images/viber.png') }}" alt="Phone Icon" style="height:18px;">
                    <span>0821-1234-5678</span>
                </div>
            </div>
        </div>
        <button class="start-btn" style="background:#69FD8D; color:#fff; border:none; border-radius:25px; padding:12px 32px; font-weight:700px; font-size:16px; cursor:pointer;">Mulai Perjalananmu</button>
    </footer>
</body>
</html>
