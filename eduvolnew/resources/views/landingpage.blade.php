@extends('layouts.main')

@section('title', 'Landing Page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
@endsection

@section('content')

 <!-- Hero Section -->
 <section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <button class="join-button">Join Us</button>
                <h1>Jadilah bagian dari <span class="highlight">#RelawanPintar</span> sekarang juga!</h1>
                <button class="start-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M10 8l6 4-6 4V8z"></path>
                    </svg>
                    Mulai Perjalananmu
                </button>
                <a href="#" class="learn-more">Pelajari lebih lanjut 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/volunteer-group.png') }}" alt="Volunteers">
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="container">
        <div class="stats-container">
            <div class="year">
                Di tahun <span class="bold">2024</span>, <br>
                <span class="bold">EduVolunteer</span> telah <br>
                berhasil mencapai :
            </div>
            <div class="stat-items">
                <div class="stat-item">
                    <h2>1</h2>
                    <p>Partner</p>
                </div>
                <div class="stat-item">
                    <h2>{{ $total_users }}</h2>
                    <p>Relawan</p>
                </div>
                <div class="stat-item">
                    <h2>{{ $total_events }}</h2>
                    <p>Aksi Volunteer</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Impact Section -->
<section class="impact">
    <div class="container">
        <div class="badge-section">
            <div class="badge-header">
                <div class="badge-title">
                    <span class="badge">Relawan Pintar</span>
                    <h2>More people<br>More impact</h2>
                </div>
                <div class="badge-description">
                    <p>Kami sangat menghargai partisipasi para relawan, dengan EduVolunteer kamu mendapatkan apresiasi atas partisipasi kamu dengan <a href="#" class="link">Volunteer Badge</a>!</p>
                    <a href="#" class="read-more">Baca selengkapnya</a>
                </div>
            </div>

            <div class="badge-levels">
                <div class="badge-card">
                    <h3>Volunteer Badge</h3>
                    <div class="badge-level">
                        <div class="badge-icon bronze"></div>
                        <div class="badge-info">
                            <span class="badge-range">1-10</span>
                            <span class="badge-type">Relawan <span class="badge-status">Pemula</span></span>
                        </div>
                    </div>
                    <div class="badge-level">
                        <div class="badge-icon silver"></div>
                        <div class="badge-info">
                            <span class="badge-range">11-30</span>
                            <span class="badge-type">Relawan <span class="badge-status">Aktif</span></span>
                        </div>
                    </div>
                    <div class="badge-level">
                        <div class="badge-icon gold"></div>
                        <div class="badge-info">
                            <span class="badge-range">>30</span>
                            <span class="badge-type">Relawan <span class="badge-status">Inspiratif</span></span>
                        </div>
                    </div>
                    <p class="badge-note">Tingkatkan partisipasi kamu di EduVolunteer dan dapatkan badge dan keuntungan lainnya</p>
                </div>

                <div class="volunteer-profiles">
                   @foreach($topVolunteers as $volunteer)
                        @php
                            // Ambil first name dari full_name (string sebelum spasi pertama)
                            $firstName = explode(' ', $volunteer->full_name)[0];
                        @endphp
                        <div class="volunteer-card {{ $loop->iteration == 1 ? 'pink' : ($loop->iteration == 2 ? 'blue' : 'orange') }}">
                            {{-- Foto kalau ada, kalau tidak pakai default --}}
                            @php
                                $photo = property_exists($volunteer, 'profile_photo') && $volunteer->profile_photo 
                                    ? asset('storage/profile_photos/' . $volunteer->profile_photo) 
                                    : asset('images/default-volunteer.png');
                            @endphp
                            <img src="{{ $photo }}" alt="Volunteer">
                            <div class="volunteer-info">
                                <div class="participation">
                                    <span class="participation-number">{{ $volunteer->event_count }}</span>
                                    <span class="participation-text">events</span>
                                </div>
                                {{-- Tampilkan first name dengan lowercase --}}
                                <p>{{ strtolower($firstName) }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Community Section -->
<section class="community">
    <div class="container">
        <div class="community-content">
            <div class="community-text">
                <span class="partnership-badge">Open Partnership (Mitra)</span>
                <h2>Bangun komunitas impian dengan platform yang tepat dan terpercaya!</h2>
                <a href="#" class="read-more-btn">Baca selengkapnya</a>
                
                <div class="feature-cards">
                    <div class="feature-card">
                        <div class="feature-icon community-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="feature-info">
                            <h3>Komunitas Berkelanjutan</h3>
                            <p>Sejalan dengan SDGs 4 yaitu Quality Education dan SDGs 10 Reduced Inequalities, kami hadir sebagai platform untuk para komunitas hebat.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon global-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                        </div>
                        <div class="feature-info">
                            <h3>Menjangkau Seluruh Daerah</h3>
                            <p>Dengan adanya platform ini diharapkan bantuan pendidikan dapat kemana saja dengan komunitas yang tepat.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="community-images">
                <img src="{{ asset('images/community1.png') }}" alt="Community" class="community-img-1">
                <img src="{{ asset('images/community2.png') }}" alt="Community" class="community-img-2">
            </div>
        </div>
    </div>
</section>

@endsection
