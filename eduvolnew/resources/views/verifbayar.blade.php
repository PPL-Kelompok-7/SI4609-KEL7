<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Pembayaran</title>
    <link rel="stylesheet" href="/css/verifbayar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <img src="/EDUVOL LOGO 1.png" alt="EDU Volunteer Logo" class="logo" style="height:40px;margin-right:10px;">
        </div>
        <div class="navbar-right">
            <span style="color:white;font-size:16px;">Hi, Admin <b>{{ Auth::user()->first_name }}</b></span>
            <button class="logout-btn">Log Out</button>
        </div>
    </nav>
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li><a href="#">Dashboard</a></li>
            <li class="active"><a href="#">Verifikasi Pembayaran</a></li>
            <li><a href="#">Notifikasi</a></li>
        </ul>
    </div>
    <!-- Main Content -->
    <div class="content">
        <div class="container" style="width:85%;max-width:1100px;margin:0 auto;">
            <div class="title-area">
                <span class="star">★</span>
                <span class="title-text">Verifikasi Pembayaran</span>
            </div>
            <div class="filter-box">
                <div class="filter-left">
                    <span class="filter-label">Filter berdasarkan :</span>
                    <label><input type="checkbox" name="status" value="all"> All</label>
                    <label><input type="checkbox" name="status" value="pending"> Pending</label>
                    <label><input type="checkbox" name="status" value="accepted"> Diterima</label>
                    <label><input type="checkbox" name="status" value="rejected"> Ditolak</label>
                </div>
                <div class="filter-right">
                    <button class="apply">Terapkan</button>
                    <button class="reset">Hapus Filter</button>
                </div>
            </div>
            <table class="event-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Nama Pengguna</th>
                        <th>Tanggal Upload</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>123456789</td>
                        <td>Selsya Nabila</td>
                        <td>18/05/2025<br>08.30</td>
                        <td style="color:#3c28d4;font-weight:600;">Pending</td>
                        <td>
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn accept"><i class="fas fa-check"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>123456789</td>
                        <td>Cheryl Regar</td>
                        <td>19/05/2025<br>08.30</td>
                        <td style="color:#00b359;font-weight:600;">Diterima</td>
                        <td>
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn accept" disabled style="opacity:0.5;"><i class="fas fa-check"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
