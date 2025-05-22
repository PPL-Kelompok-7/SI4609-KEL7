<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Event</title>
    {{-- Link CSS khusus untuk halaman ini --}}
    <link rel="stylesheet" href="{{ asset('css/verifevent.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    {{-- Navbar (sesuaikan jika navbar terpisah) --}}
    <nav class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('EDUVOL LOGO 1.png') }}" alt="EDU Volunteer Logo" class="logo" style="height:40px;margin-right:10px;">
        </div>
        <div class="navbar-right">
            <span style="color:white;font-size:16px;">Hi, Admin <b>{{ Auth::user()->first_name ?? 'Admin' }}</b></span>
            {{-- Tambahkan form logout jika diperlukan --}}
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
             <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</button>
        </div>
    </nav>

    {{-- Sidebar (sesuaikan path include jika berbeda) --}}
    {{-- Asumsi sidebar mirip verifbayar, dengan item aktif disesuaikan --}}
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li><a href="#">Dashboard</a></li> {{-- Ganti # dengan route dashboard sebenarnya --}}
            <li><a href="{{ route('verifbayar') }}">Verifikasi Pembayaran</a></li>
            <li class="active"><a href="{{ route('verification.event.index') }}">Verifikasi Event</a></li> {{-- Route yang sudah kita buat --}}
            <li><a href="#">Notifikasi</a></li> {{-- Ganti # dengan route notifikasi sebenarnya --}}
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="content">
        <div class="container" style="width:85%;max-width:1100px;margin:0 auto;"> {{-- Container utama --}}
            <div class="title-area"> {{-- Judul Halaman --}}
                <span class="star">★</span>
                <span class="title-text">Verifikasi Event</span>
            </div>

            {{-- Filter Box (opsional, bisa disesuaikan nanti) --}}
            <div class="filter-box">
                {{-- Form untuk filter --}}
                <form action="{{ route('verification.event.index') }}" method="GET" style="display: flex; justify-content: space-between; align-items: center; width: 100%; flex-wrap: wrap; gap: 10px;">
                    <div class="filter-left" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <span class="filter-label">Filter berdasarkan :</span>
                        {{-- Kategori filter baru --}}
                        {{-- Pastikan name="status[]" untuk multiple select --}}
                        <label><input type="checkbox" name="status[]" value="all" {{ in_array('all', request('status', [])) ? 'checked' : '' }}> All</label>
                        <label><input type="checkbox" name="status[]" value="Draft" {{ in_array('Draft', request('status', [])) ? 'checked' : '' }}> Draft</label>
                        <label><input type="checkbox" name="status[]" value="Sudah Dikonfirmasi" {{ in_array('Sudah Dikonfirmasi', request('status', [])) ? 'checked' : '' }}> Sudah Dikonfirmasi</label>
                        <label><input type="checkbox" name="status[]" value="Cancelled" {{ in_array('Cancelled', request('status', [])) ? 'checked' : '' }}> Cancelled</label>
                    </div>
                    <div class="filter-right" style="display: flex; gap: 10px;">
                        <button type="submit" class="apply">Terapkan</button>
                        {{-- Link untuk mereset filter --}}
                        <a href="{{ route('verification.event.index') }}" class="reset" style="text-decoration: none; display: inline-block; text-align: center; padding: 6px 14px; border-radius: 8px; color: white; font-weight: bold; background-color: #ff4d4d; border: 2px solid white;">Hapus Filter</a>
                    </div>
                </form>
            </div>

            {{-- Tabel Data Event --}}
            <table class="event-table"> {{-- Gunakan kelas tabel yang sama --}}
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Event</th>
                        <th>Nama Event</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Lokasi Event</th>
                        <th>Harga Event</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data event dari controller di sini --}}
                    @if(isset($events) && $events->count() > 0)
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td> {{-- Nomor urut --}}
                                <td>{{ $event->id }}</td> {{-- ID Event --}}
                                <td>{{ $event->title ?? '-' }}</td> {{-- Nama Event --}}
                                <td>{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->translatedFormat('d/m/Y') : '-' }}</td> {{-- Tanggal Mulai --}}
                                <td>{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->translatedFormat('d/m/Y') : '-' }}</td> {{-- Tanggal Berakhir --}}
                                <td>{{ $event->location ?? '-' }}</td> {{-- Lokasi Event --}}
                                <td>{{ $event->price > 0 ? 'Rp ' . number_format($event->price, 0, ',', '.') : 'Gratis' }}</td> {{-- Harga Event --}}
                                {{-- Status Event --}}
                                <td>{{ $event->status->name ?? ($event->status_id ?? '-') }}</td> {{-- Tampilkan nama status jika ada relasi, fallback ke ID --}}
                                <td>
                                    {{-- Tombol View (sesuaikan route jika perlu) --}}
                                    <a href="#" class="action-btn view" title="Lihat Detail Event"> {{-- Ganti # dengan route detail event --}}
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- Tombol Accept --}}
                                    @if($event->status->name === 'Draft') {{-- Ubah kondisi menjadi 'Draft' --}}
                                        <form action="{{ route('verification.event.accept', $event->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui event ini?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="action-btn accept" title="Setujui Event">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="action-btn accept" disabled style="opacity:0.5;" title="Sudah Dikonfirmasi">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @endif
                                    {{-- Tombol Reject/Delete (implementasikan nanti) --}}
                                    <button class="action-btn delete" title="Tolak Event"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" style="text-align:center;">Tidak ada event yang perlu diverifikasi.</td> {{-- Pesan jika tidak ada data --}}
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    {{-- Tambahkan script JavaScript lainnya di sini jika perlu --}}
</body>
</html> 