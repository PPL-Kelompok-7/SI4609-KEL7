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
            <li class="active"><a href="{{ route('verifbayar') }}">Verifikasi Pembayaran</a></li>
            <li><a href="{{ route('verification.event.index') }}">Verifikasi Event</a></li>
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
                {{-- Form untuk filter --}}
                <form action="{{ route('verifbayar') }}" method="GET" style="display: flex; justify-content: space-between; align-items: center; width: 100%; flex-wrap: wrap; gap: 10px;">
                    <div class="filter-left" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <span class="filter-label">Filter berdasarkan :</span>
                        {{-- Pastikan name="status[]" untuk multiple select --}}
                        <label><input type="checkbox" name="status[]" value="all" {{ in_array('all', request('status', [])) ? 'checked' : '' }}> All</label>
                        <label><input type="checkbox" name="status[]" value="Paid" {{ in_array('Paid', request('status', [])) ? 'checked' : '' }}> Paid</label>
                        <label><input type="checkbox" name="status[]" value="On Verification" {{ in_array('On Verification', request('status', [])) ? 'checked' : '' }}> On Verification</label>
                        <label><input type="checkbox" name="status[]" value="Failed" {{ in_array('Failed', request('status', [])) ? 'checked' : '' }}> Failed</label>
                    </div>
                    <div class="filter-right" style="display: flex; gap: 10px;">
                        <button type="submit" class="apply">Terapkan</button>
                        {{-- Link untuk mereset filter --}}
                        <a href="{{ route('verifbayar') }}" class="reset" style="text-decoration: none; display: inline-block; text-align: center; padding: 6px 14px; border-radius: 8px; color: white; font-weight: bold; background-color: #ff4d4d; border: 2px solid white;">Hapus Filter</a>
                    </div>
                </form>
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
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->user->first_name ?? '-' }} {{ $payment->user->last_name ?? '-' }}</td>
                            <td>{!! $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->translatedFormat('d/m/Y') . '<br>' . \Carbon\Carbon::parse($payment->payment_date)->translatedFormat('H:i') : '-' !!}</td>
                            <td style="color:{{ $payment->paymentStatus->name === 'Pending' ? '#3c28d4' : ($payment->paymentStatus->name === 'Diterima' ? '#00b359' : '#222') }};font-weight:600;">{{ $payment->paymentStatus->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('payments.showProof', $payment->id) }}" class="action-btn view" title="Lihat Bukti Bayar">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($payment->paymentStatus->name === 'Pending' || $payment->paymentStatus->name === 'On Verification')
                                    <form action="{{ route('payments.accept', $payment->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pembayaran ini?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="action-btn accept" title="Setujui Pembayaran">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @else
                                     <button class="action-btn accept" disabled style="opacity:0.5;" title="Sudah Disetujui">
                                        <i class="fas fa-check"></i>
                                     </button>
                                @endif
                                <button class="action-btn delete" title="Tolak Pembayaran"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
