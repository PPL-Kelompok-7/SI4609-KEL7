<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event - Ngajar Ngoding</title>
    <link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">
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
                    <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('profile1.png') }}" alt="Profil" style="height:38px;width:38px;border-radius:50%;object-fit:cover;border:2px solid #4E36E9;">
                    <span style="color:white;font-size:16px;margin-left:6px;">{{ Auth::user()->first_name }}</span>
                </a>
            @else
                <img src="{{ asset('profile1.png') }}" alt="Profil" style="height:38px;width:38px;border-radius:50%;object-fit:cover;">
                <span style="color:white;font-size:16px;margin-left:6px;">Profil</span>
            @endauth
        </div>
    </nav>
    <div class="event-detail-container" style="padding-top:90px;">
        <div class="breadcrumb">
            <a href="#">Beranda</a>
            <a href="{{ url('/events') }}">Agenda</a> 
            <span>Detail Event</span>
        </div>

        <div class="event-detail-wrapper">
            <div class="event-main">
                <div class="banner-wrapper">
                    <div class="logo-circle">
                        <img src="{{ asset('images/logo-telkom-schools.png') }}" alt="Logo" style="width: 30px; height: 40px;">
                    </div>
                    <img src="{{ $event->event_photo ? asset('storage/'.$event->event_photo) : asset('images/ngajar-ngoding.jpg') }}" alt="Event Banner" class="event-banner">
                </div>
                <div class="tab-menu">
                    <span class="active">Deskripsi</span>
                    <span>Syarat & Ketentuan</span>
                </div>
                <hr class="divider"> <!-- Garis pemisah ditambahkan di sini -->

                <!-- Deskripsi -->
                <div class="event-description" id="tab-deskripsi">
                    {!! nl2br(e($event->description)) !!}
                </div>

                <!-- Syarat & Ketentuan -->
                <div class="event-description" id="tab-syarat" style="display: none;">
                    {!! nl2br(e($event->terms)) !!}
                </div>
            </div>

            <div class="event-sidebar">
                <div class="event-card">
                    <h3>{{ $event->title }}</h3>
                    <ul class="event-info">
                        <li><img src="{{ asset('images/calendar.png') }}" alt=""> {{ $tanggal }}</li>
                        <li><img src="{{ asset('images/time.png') }}" alt=""> {{ $jam }}</li>
                        <li><img src="{{ asset('images/location1.png') }}" alt=""> {{ $event->location }}</li>
                    </ul>
                    <hr class="divider"> <!-- Garis pemisah ditambahkan di sini -->
                    <div class="event-host">
                        <img src="{{ asset('images/logo-telkom-schools.png') }}" alt="" style="width: 30px; height: 40px;">
                        <div class="event-host-text">
                            <p class="host-label">Diselenggarakan oleh</p>
                            <p><strong>SMK Telkom Bandung</strong></p>
                        </div>
                    </div>
                </div>

                <div class="event-price-card">
                    <div class="task-icon">
                        <img src="{{ asset('images/tickets.png') }}" alt="">
                        <p>Kamu belum memilih tiket.<br>Silakan klik "ikut partisipasi" jika kamu tertarik!</p>
                    </div>
                    <hr class="divider"> <!-- Garis pemisah ditambahkan di sini -->
                    <div class="price-tag">
                        <p>Harga</p>
                        <strong>{{ $harga }}</strong>
                    </div>
                    <button class="btn-join">Ikut Partisipasi</button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer" style="background:#000; color:white; display:flex; justify-content:space-between; align-items:center; padding:20px 60px; position:fixed; left:0; right:0; bottom:0; z-index:1000;">
            <div style="display:flex; align-items:center; gap:16px;">
                <img src="{{ asset('images/EDUVOL LOGO 1.png') }}" alt="Logo EduVolunteer" style="height:40px;">
                <div style="margin-left:175px;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <img src="{{ asset('images/location.png') }}" alt="Location Icon" style="height:18px;">
                        <span>Bandung, Indonesia</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <img src="{{ asset('images/viber.png') }}" alt="Phone Icon" style="height:18px;">
                        <span>0821-1234-5678</span>
                    </div>
                </div>
            </div>
            <button class="start-btn" style="background:#69FD8D; color:#000; border:none; border-radius:25px; padding:12px 32px; font-weight:700px; font-size:16px; cursor:pointer;">Mulai Perjalananmu</button>
        </footer>
    </div>

    <script>
        const tabDeskripsi = document.querySelector('.tab-menu span:nth-child(1)');
        const tabSyarat = document.querySelector('.tab-menu span:nth-child(2)');
        const contentDeskripsi = document.getElementById('tab-deskripsi');
        const contentSyarat = document.getElementById('tab-syarat');

        // Fungsi untuk menangani klik pada tab "Deskripsi"
        tabDeskripsi.addEventListener('click', () => {
            tabDeskripsi.classList.add('active'); // Memberikan kelas 'active' pada tab Deskripsi
            tabSyarat.classList.remove('active'); // Menghapus kelas 'active' dari tab Syarat
            contentDeskripsi.style.display = 'block'; // Menampilkan konten Deskripsi
            contentSyarat.style.display = 'none'; // Menyembunyikan konten Syarat & Ketentuan
        });

        // Fungsi untuk menangani klik pada tab "Syarat & Ketentuan"
        tabSyarat.addEventListener('click', () => {
            tabSyarat.classList.add('active'); // Memberikan kelas 'active' pada tab Syarat & Ketentuan
            tabDeskripsi.classList.remove('active'); // Menghapus kelas 'active' dari tab Deskripsi
            contentDeskripsi.style.display = 'none'; // Menyembunyikan konten Deskripsi
            contentSyarat.style.display = 'block'; // Menampilkan konten Syarat & Ketentuan
        });
    </script>
</body>
</html>
