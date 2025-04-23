<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event - Ngajar Ngoding</title>
    <link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">
</head>
<body>
    <div class="event-detail-container">
        <div class="breadcrumb">
            <a href="#">Beranda</a>
            <a href="#">Agenda</a> 
            <span>Detail Event</span>
        </div>

        <div class="event-detail-wrapper">
            <div class="event-main">
                <div class="banner-wrapper">
                    <div class="logo-circle">
                        <img src="{{ asset('images/logo-telkom-schools.png') }}" alt="Logo" style="width: 30px; height: 40px;">
                    </div>
                    <img src="{{ asset('images/ngajar-ngoding.jpg') }}" alt="Ngajar Ngoding" class="event-banner">
                </div>
                <div class="tab-menu">
                    <span class="active">Deskripsi</span>
                    <span>Syarat & Ketentuan</span>
                </div>
                <hr class="divider"> <!-- Garis pemisah ditambahkan di sini -->

                <!-- Deskripsi -->
                <div class="event-description" id="tab-deskripsi">
                    <p>Ngajar Ngoding adalah kegiatan relawan yang bertujuan untuk memberikan edukasi pemrograman kepada siswa SMK Telkom. Dalam kegiatan ini, para relawan akan mengajarkan konsep dasar coding, seperti algoritma, logika pemrograman, serta praktik menggunakan bahasa pemrograman seperti HTML, CSS, JavaScript, atau Python.</p>
                    <p>Kegiatan ini dirancang untuk membantu siswa mengembangkan keterampilan teknologi yang relevan dengan dunia industri, meningkatkan pemahaman mereka tentang pemrograman, serta mendorong kreativitas dan pemecahan masalah melalui coding. Dengan metode pembelajaran interaktif dan praktik langsung, siswa akan mendapatkan pengalaman nyata dalam mengembangkan proyek digital sederhana.</p>
                    <p>Ngajar Ngoding tidak hanya memberikan wawasan baru, tetapi juga menjadi ajang berbagi dan kolaborasi antara relawan dan siswa, membangun semangat belajar, serta mempersiapkan generasi muda untuk menghadapi tantangan dunia digital.</p>
                </div>

                <!-- Syarat & Ketentuan -->
                <div class="event-description" id="tab-syarat" style="display: none;">
                    <ul>
                        <li>Peserta merupakan pelajar atau umum yang memiliki minat dalam bidang pemrograman.</li>
                        <li>Wajib membawa laptop pribadi saat kegiatan berlangsung.</li>
                        <li>Mengisi form registrasi dan melakukan pembayaran sebelum tenggat waktu.</li>
                        <li>Menjaga ketertiban dan mengikuti arahan dari panitia selama kegiatan berlangsung.</li>
                        <li>Tiket yang telah dibeli tidak dapat diuangkan kembali (non-refundable).</li>
                    </ul>
                </div>
            </div>

            <div class="event-sidebar">
                <div class="event-card">
                    <h3>Ngajar Ngoding Selasa #6<br>Dasar Bahasa Pemrograman PHP</h3>
                    <ul class="event-info">
                        <li><img src="{{ asset('images/calendar.png') }}" alt=""> 22 Oktober 2025</li>
                        <li><img src="{{ asset('images/time.png') }}" alt=""> 09:00 - 14:00</li>
                        <li><img src="{{ asset('images/location1.png') }}" alt=""> Ruangan Multimedia SMK Telkom Bandung</li>
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
                        <p>Kamu belum memilih tiket.<br>Silakan klik “ikut partisipasi” jika kamu tertarik!</p>
                    </div>
                    <hr class="divider"> <!-- Garis pemisah ditambahkan di sini -->
                    <div class="price-tag">
                        <p>Harga</p>
                        <strong>Rp210.000</strong>
                    </div>
                    <button class="btn-join">Ikut Partisipasi</button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <!-- <footer class="footer">
            <div class="footer-left">
                <img src="{{ asset('images/edu-logo.png') }}" alt="Edu Volunteer">
            </div>
            <div class="footer-mid">
                <p>📍 Bandung, Indonesia</p>
                <p>📞 0821-1234-5678</p>
            </div>
            <div class="footer-right">
                <a href="#" class="btn-start">🌱 Mulai Perjalananmu</a>
            </div>
        </footer>
    </div> -->

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
