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
                <img src="{{ asset('Mask group.png') }}" alt="Event Image" class="background-img">

                <div class="logo-bulet">
                    <img src="{{ asset('telkom.png') }}" alt="Logo Telkom" class="logo-img">
                </div>

                <div class="center-text">
                    NGAJAR NGODING
                </div>
            </div>

            <!-- Info event dalam box putih -->
            <div class="event-text-box">
                <h1>Ngajar Ngoding Selasa #6 Dasar Bahasa Pemrograman PHP</h1>
                <ul style="list-style: none; padding: 0; font-size: 15px; line-height: 1.8;">
                    <li>
                        <i class="fas fa-calendar-day" style="color: #4728f0; width: 20px; display: inline-block; text-align: center; transform: translateY(1px);"></i>
                        22 Oktober 2025
                    </li>
                    <li>
                        <i class="fas fa-clock" style="color: #4728f0; width: 20px; display: inline-block; text-align: center; transform: translateY(2px);"></i>
                        09:00 – 14:00
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt" style="color: #4728f0; width: 20px; display: inline-block; text-align: center; transform: translateY(4px);"></i>
                        Ruangan Multimedia SMK Telkom Bandung
                    </li>
                </ul>


            </div>

        </div>

        <!-- Ticket Box -->
        <div class="ticket-box">
            <div class="ticket-left">
                <span class="ticket-title">Jenis Tiket</span>
                <span class="ticket-name">Ngajar Ngoding Selasa #6 Dasar Bahasa Pemrograman PHP</span>
            </div>
            <div class="ticket-right">
                <span class="ticket-label">Harga</span>
                <span class="ticket-price">Rp 210.000</span>
            </div>
        </div>

    </div> <!-- penutup event-section-purple -->

    <!-- Form di luar area ungu -->
    <div class="form-container">
        <form action="#" method="POST">
            @csrf
            <h2>Detail Pemesanan</h2>
            <label>Nama Lengkap <span class="required">*</span></label>
            <p class="input-hint">Gunakan nama yang tertera di KTP/Paspor</p>
            <input type="text">

            <label>Email <span class="required">*</span></label>
            <p class="input-hint">Salinan E-tiket akan dikirim ke email kamu.</p>
            <input type="email">


            <label>Nomor Handphone <span class="required">*</span></label>
            <div class="phone-input">
                <span>+62</span>
                <input type="text" placeholder="899-xxxx-xxxx">
            </div>

            <label>Tanggal Lahir <span class="required">*</span></label>
            <input type="date">

            <label>Apakah Anda Sudah Berkeluarga? <span class="required">*</span></label>
            <div class="radio-group">
                <label><input type="radio" name="keluarga"> Belum berkeluarga</label>
                <label><input type="radio" name="keluarga"> Sudah berkeluarga dan belum memiliki anak</label>
                <label><input type="radio" name="keluarga"> Sudah berkeluarga dan memiliki anak</label>
            </div>

            <label>Saya Bersedia Untuk Membaca dan Menaati Handbook? <span class="required">*</span></label>
            <div class="radio-group">
                <label><input type="radio" name="handbook"> Ya, saya bersedia.</label>
                <label><input type="radio" name="handbook"> Tidak bersedia</label>
            </div>
        </form>

        <!-- Sidebar Harga -->
        <div class="sidebar">
            <div class="promo">
                <input type="text" placeholder="Kode Promo">
                <button>Terapkan</button>
            </div>
            <p class="promo-note">Pilih metode pembayaran terlebih dahulu untuk menggunakan kode promo</p>

            <div class="harga">
                <p class="judul">Detail Harga</p>
                <div class="harga-item">
                    <span>Total Harga Tiket</span>
                    <span>Rp 210.000</span>
                </div>
                <div class="harga-item">
                    <span>Biaya Platform</span>
                    <span>Rp 0</span>
                </div>
                <!-- Tambahkan ini sebelum total bayar -->
                <hr class="divider">

                <div class="harga-item total">
                    <span>Total Bayar</span>
                    <span class="total-amount">Rp 210.000</span>
                </div>

                <!-- Tambahkan ini setelah total bayar -->
                <hr class="divider">

            </div>
            <div class="checkboxes">
                <label><input type="checkbox"> Saya setuju dengan Syarat dan Ketentuan yang berlaku di EduVolunteer.com</label>
                <label><input type="checkbox"> Saya setuju dengan Pemrosesan Data Pribadi yang berlaku di EduVolunteer.com</label>

                <p class="warning">Syarat & Ketentuan dan Pemrosesan Data Pribadi harus disetujui</p>
            </div>
            <button class="submit-btn">Ikut Partisipasi</button>
        </div>
    </div>
</body>


</html>