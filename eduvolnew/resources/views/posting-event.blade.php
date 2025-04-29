<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Event Saya</title>
    <link rel="stylesheet" href="{{ asset('css/posting-event.css') }}">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="title-left">
                <span class="star">★</span>
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
            <button class="add-event-btn">Tambah Event</button>
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
                <tr>
                    <td><span class="dot coming-soon"></span></td>
                    <td>Ngajar Ngoding Selasa #6 Dasar Bahasa Pemrograman PHP</td>
                    <td><span class="confirmation pending">Belum Dikonfirmasi</span></td> <!-- Tambahan -->
                    <td>
                        <button class="detail-btn">
                            <span class="icon-eye">👁</span>
                            <span>Lihat Detail Event</span>
                        </button>
                    </td>
                </tr>
                <!-- <tr>
                    <td><span class="dot ended"></span></td>
                    <td>Ngajar Ngoding Selasa #2</td> -->
                    <!-- <td><span class="confirmation pending">Belum Dikonfirmasi</span></td> Tambahan
                    <td>
                        <button class="detail-btn">
                            <span class="icon-eye">👁</span>
                            <span>Lihat Detail Event</span>
                        </button>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
</body>

</html>
