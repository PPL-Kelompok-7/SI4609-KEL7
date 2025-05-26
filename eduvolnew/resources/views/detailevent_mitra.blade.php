<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event Mitra</title>
    {{-- Sisipkan kembali link CSS yang relevan di sini --}}
    <link rel="stylesheet" href="{{ asset('css/detail-event-mitra.css') }}"> {{-- CSS spesifik halaman ini --}}
    {{-- Anda mungkin juga perlu menyisipkan CSS umum jika ada --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}} {{-- Contoh CSS umum --}}
    
</head>
<body>
    {{-- Konten utama dari halaman detail event mitra --}}
    <div class="container">
        {{-- Breadcrumb (Optional, based on image) --}}
        <div class="breadcrumb">
            <a href="{{ url('/posting-event') }}">Event Saya</a> 
            <span>Detail Event</span>
        </div>

        <div class="event-detail-container">
            <div class="event-image-section">
                <img src="{{ asset('storage/' . $event->event_photo) }}" alt="Event Image" class="event-main-image">
                <div class="event-image-overlay">
                    <h2 class="event-title-overlay">{{ $event->title }}</h2>
                </div>
            </div>

            <div class="event-info-section">
                <div class="event-info-card">
                    <h3>{{ $event->title }}</h3> {{-- Atau judul yang lebih pendek jika perlu --}}
                    <p><i class="far fa-calendar-alt"></i> {{ $tanggal }}</p>
                    <p><i class="far fa-clock"></i> {{ $jam }}</p>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
                    
                    {{-- Bagian diselenggarakan oleh --}}
                    <div class="organized-by">
                        <p>Diselenggarakan oleh</p>
                        <div class="organizer-info">
                             <img src="{{ asset('images/logo-telkom-schools.png') }}" alt="Organizer Logo" class="organizer-logo">
                            <span>SMK Telkom Bandung</span> {{-- Ganti dengan nama mitra jika data tersedia --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="event-description-section">
            <div class="tabs">
                <button class="tab-link active">Deskripsi</button>
                <button class="tab-link">Syarat & Ketentuan</button>
            </div>
            <div class="tab-content">
                <div class="tab-pane active">
                    <p>{{ $event->description }}</p>
                </div>
                <div class="tab-pane">
                    <p>{{ $event->terms }}</p> {{-- Asumsi kolom 'terms' di model Event --}}
                </div>
            </div>
        </div>

        {{-- Tambahkan bagian lain sesuai kebutuhan mitra, contoh: daftar relawan --}}
        {{-- <div class="volunteer-list-section">
            <h4>Daftar Relawan</h4>
            ... kode untuk menampilkan daftar relawan ...
        </div> --}}

    </div>

    {{-- Sisipkan kembali script JS yang relevan di sini --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-link');
            const panes = document.querySelectorAll('.tab-pane');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabIndex = Array.from(tabs).indexOf(this);

                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    panes.forEach(p => p.classList.remove('active'));
                    panes[tabIndex].classList.add('active');
                });
            });
        });
    </script>
    {{-- Anda mungkin juga perlu menyisipkan script JS umum jika ada --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}} {{-- Contoh JS umum --}}
</body>
</html> 