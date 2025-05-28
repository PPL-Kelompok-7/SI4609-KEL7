@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event</title>
    <link rel="stylesheet" href="{{ asset('css/daftarrelawan.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <!-- Bungkus Ungu -->
    <div class="event-section-purple">

        <div class="event-header">
            <div class="image-mask-group">
                <img src="{{ asset($event->event_photo ? 'storage/' . $event->event_photo : 'Mask group.png') }}" alt="Event Image" class="background-img">

                <div class="logo-bulet">
                    <img src="{{ asset('telkom.png') }}" alt="Logo Telkom" class="logo-img">
                </div>

                <div class="center-text">
                    {{ $event->title }}
                </div>
            </div>

            <!-- Info event dalam box putih -->
            <div class="event-text-box">
                <h1>{{ $event->title }}</h1>
                <ul style="list-style: none; padding: 0; font-size: 15px; line-height: 1.8;">
                    <li>
                        <i class="fas fa-calendar-day" style="color: #4728f0; width: 20px; display: inline-block; text-align: center; transform: translateY(1px);"></i>
                        {{ $tanggal }}
                    </li>
                    <li>
                        <i class="fas fa-clock" style="color: #4728f0; width: 20px; display: inline-block; text-align: center; transform: translateY(2px);"></i>
                        {{ $jam }}
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt" style="color: #4728f0; width: 20px; display: inline-block; text-align: center; transform: translateY(4px);"></i>
                        {{ $event->location }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- Ticket Box -->
        <div class="ticket-box">
            <div class="ticket-left">
                <span class="ticket-title">Jenis Tiket</span>
                <span class="ticket-name">{{ $event->title }}</span>
            </div>
            <div class="ticket-right">
                <span class="ticket-label">Harga</span>
                <span class="ticket-price">{{ $harga }}</span>
            </div>
        </div>

    </div> <!-- penutup event-section-purple -->

    <!-- Form di luar area ungu -->
    <div class="form-container">
        <form action="{{ route('regist-event.store') }}" method="POST" style="display: flex; gap: 30px; width: 100%;">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <!-- KIRI: Form Detail Pemesanan -->
            <div class="form-left" style="flex:2;">
                <h2>Detail Pemesanan</h2>
                <label>Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="nama_lengkap" value="{{ $user->first_name . ' ' . $user->last_name }}" required readonly>

                <label>Email <span class="required">*</span></label>
                <input type="email" name="email" value="{{ $user->email }}" required readonly>

                <label>Nomor Handphone <span class="required">*</span></label>
                <input type="text" name="mobile_phone" placeholder="899-xxxx-xxxx" required>

                <label>Tanggal Lahir <span class="required">*</span></label>
                <input type="date" name="birth_date" value="{{ $user->birth_date }}" required readonly>

                <label>Apakah Anda Sudah Berkeluarga? <span class="required">*</span></label>
                <div class="radio-group">
                    <label><input type="radio" name="keluarga" value="belum" required> Belum berkeluarga</label>
                    <label><input type="radio" name="keluarga" value="sudah_tanpa_anak"> Sudah berkeluarga dan belum memiliki anak</label>
                    <label><input type="radio" name="keluarga" value="sudah_dengan_anak"> Sudah berkeluarga dan memiliki anak</label>
                </div>

                <label>Saya Bersedia Untuk Membaca dan Menaati Handbook? <span class="required">*</span></label>
                <div class="radio-group">
                    <label><input type="radio" name="handbook" value="ya" required> Ya, saya bersedia.</label>
                    <label><input type="radio" name="handbook" value="tidak"> Tidak bersedia</label>
                </div>
            </div>
            <!-- KANAN: Sidebar -->
            <div class="sidebar" style="flex:1;">

                <div class="harga">
                    <p class="judul">Detail Harga</p>
                    <div class="harga-item">
                        <span>Total Harga Tiket</span>
                        <span>{{ $harga }}</span>
                    </div>
                    <div class="harga-item">
                        <span>Biaya Platform</span>
                        <span>Rp 0</span>
                    </div>
                    <hr class="divider">

                    <div class="harga-item total">
                        <span>Total Bayar</span>
                        <span class="total-amount">{{ $harga }}</span>
                    </div>

                    <hr class="divider">
                </div>
                <div class="checkboxes">
                    <label><input type="checkbox" required> Saya setuju dengan Syarat dan Ketentuan yang berlaku di EduVolunteer.com</label>
                    <label><input type="checkbox" required> Saya setuju dengan Pemrosesan Data Pribadi yang berlaku di EduVolunteer.com</label>

                    <p class="warning">Syarat & Ketentuan dan Pemrosesan Data Pribadi harus disetujui</p>
                </div>
                <button class="submit-btn" type="submit">Ikut Partisipasi</button>
            </div>
        </form>
    </div>
</body>

</html>
@endsection