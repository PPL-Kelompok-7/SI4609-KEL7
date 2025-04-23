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
</div>
@endsection
