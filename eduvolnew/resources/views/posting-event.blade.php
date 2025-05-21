<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Event Saya</title>
    <link rel="stylesheet" href="{{ asset('css/posting-event.css') }}">
</head>

<body>
    <div class="main-layout">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="menu">
                <a href="#" class="menu-item">Dashboard</a>
                <a href="#" class="menu-item active">Event Saya</a>
                <a href="{{ url('/notifikasi') }}" class="menu-item">Notifikasi</a>
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
                        <img src="{{ asset('images\logo-telkom-schools.png') }}" alt="SMK Telkom Bandung">
                    </div>
                    <span class="school-name">SMK Telkom Bandung</span>
                </div>
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            </div>
            <!-- Main Content (existing) -->
            <div class="main-content">
                <!-- Existing content starts here -->
                <div class="container">
                    <div class="header">
                        <div class="title-left">
                        <img src="{{ asset('images/star.png') }}" alt="Star Icon" style="width: 32px; height: 32px;">
                            <span class="title-text"><span class="green">Event</span> Saya</span>
                        </div>
                        <div class="status-summary">
                            <div class="status-box">
                                <span class="dot green"></span>
                                <div><strong>2</strong><br>On Going</div>
                            </div>
                            <div class="status-box">
                                <span class="dot orange"></span>
                                <div><strong>1</strong><br>Coming Soon</div>
                            </div>
                            <div class="status-box">
                                <span class="dot grey"></span>
                                <div><strong>10</strong><br>Ended</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Tambah Event -->
                    <div class="add-event-container">
                        <a href="{{ url('/formposting-event') }}" class="add-event-btn" style="text-decoration:none;display:inline-block;">Tambah Event</a>
                    </div>

                    <table class="event-table">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Nama Event</th>
                                <th>Status Konfirmasi</th> <!-- Tambahan -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td><span class="dot coming-soon"></span></td>
                                <td>{{ $event->title }}</td>
                                <td>
                                    <span class="confirmation pending">
                                        {{ $event->status_id == 1 ? 'Belum Dikonfirmasi' : 'Sudah Dikonfirmasi' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="detail-btn">
                                        <span class="icon-eye">👁</span>
                                        <span>Lihat Detail Event</span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Existing content ends here -->
            </div>
        </div>
    </div>
</body>

</html>
