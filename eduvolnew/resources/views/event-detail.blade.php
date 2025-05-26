@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">
@endsection

@section('content')
    <div class="event-detail-container" style="padding-top:30px;">
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
                    <img src="{{ !empty($event['event_photo']) ? asset('storage/' . $event['event_photo']) : asset('default-event.png') }}" alt="Event Banner" class="event-banner">
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
                    <button class="btn-join" onclick="window.location.href='{{ url('/daftarrelawan/'.$event->id) }}'">Ikut Partisipasi</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
@endpush