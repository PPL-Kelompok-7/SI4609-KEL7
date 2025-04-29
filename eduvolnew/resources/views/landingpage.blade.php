@extends('layouts.main')

@section('title', 'Landing Page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
@endsection

@section('content')
<div class="landing-container">
    <div class="landing-content">
        <div class="text-section">
            <button class="join-btn">Join Us</button>
            <h1>Jadilah bagian dari <span class="highlight">#RelawanPintar</span><br>sekarang juga!</h1>
            <div class="cta-buttons">
                <a href="#" class="btn-mulai">▶ Mulai Perjalananmu</a>
                <a href="#" class="btn-pelajari">Pelajari lebih lanjut →</a>
            </div>
        </div>
        <div class="image-section">
            <img src="{{ asset('images/volunteer-group.png') }}" alt="Relawan" />
        </div>
    </div>

    <div class="achievement-box">
        <p>Di tahun <strong>2024</strong>, <strong>EduVolunteer</strong> telah berhasil mencapai :</p>
        <div class="stats">
            <div><span class="number">50</span> Partner</div>
            <div><span class="number">430</span> Relawan</div>
            <div><span class="number">1500</span> Aksi Volunteer</div>
        </div>
    </div>



        <!-- Section Relawan Pintar -->
<div class="relawan-section">
    
<div class="relawan-header">
    <div class="relawan-header-columns">
        <div class="relawan-left">
            <span class="tag">Relawan Pintar</span>
        </div>
        <div class="relawan-right">
    <div class="text-left">
        <h2>More people <br> More impact</h2>
    </div>
    <div class="text-right">
        <p>
            Kami sangat menghargai partisipasi para relawan, dengan EduVolunteer kamu mendapatkan apresiasi atas partisipasi kamu dengan 
            <span class="badge-link">Volunteer Badge</span>!
        </p>
    </div>
    <a href="#" class="btn-baca">Baca selengkapnya</a>

</div>

    </div>
</div>


    <di/v class="badgecon">
    <div class="badge-box">
        <h3>Volunteer Badge</h3>
        <ul>
            <li><span class="badge-icon bronze"></span> 1-10 <span>Relawan Pemula</span></li>
            <li><span class="badge-icon silver"></span> 11-30 <span>Relawan Aktif</span></li>
            <li><span class="badge-icon gold"></span> >30 <span>Relawan Inspiratif</span></li>
        </ul>
        <p>Tingkatkan partisipasi kamu di EduVolunteer dan dapatkan badge dan keuntungan lainnya</p>
    </div>

        <div class="relawan-cards">
                <div class="relawan-card">
                    <div class="photo-box gold-badge">
                        <!-- Foto -->
                        <img src="{{ asset('images/deca.jpg') }}" alt="deca">
                    </div>
                    <div class="card-footer">
                        <span>60 participations</span>
                        <span>@decaanr</span>
                    </div>
                </div>

                <div class="relawan-card">
                    <div class="photo-box silver-badge">
                        <!-- Foto -->
                        <img src="{{ asset('images/siti.jpg') }}" alt="siti">
                    </div>
                    <div class="card-footer">
                        <span>30 participations</span>
                        <span>@sitihaya</span>
                    </div>
                </div>

                <div class="relawan-card">
                    <div class="photo-box bronze-badge">
                        <!-- Foto -->
                        <img src="{{ asset('images/user3.jpg') }}" alt="user3">
                    </div>
                    <div class="card-footer">
                        <span>10 participations</span>
                        <span>@username</span>
                    </div>
                </div>

                <div class="relawan-card">
                    <div class="photo-box bronze-badge">
                        <!-- Foto -->
                        <img src="{{ asset('images/user3.jpg') }}" alt="user3">
                    </div>
                    <div class="card-footer">
                        <span>10 participations</span>
                        <span>@username</span>
                    </div>
                </div>

                

                
            </div>
    </div>



    
</div>
@endsection
