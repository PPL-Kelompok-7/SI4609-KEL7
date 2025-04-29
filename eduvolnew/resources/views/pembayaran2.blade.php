@extends('layouts.main')

@section('title', 'Landing Page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
@endsection

@section('content')<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDU Volunteer - Pembayaran Berhasil</title>
    <link rel="stylesheet" href="{{ asset('css/pembayaran2.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <!-- <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="EDU Volunteer Logo">
                    <span class="logo-text">EDU <span class="volunteer">VOLUNTEER</span></span>
                </div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#" class="active">Agenda</a></li>
                        <li><a href="#">Partner Kami</a></li>
                        <li><a href="#">Relawan Kami</a></li>
                    </ul>
                </nav>
                <div class="user-actions">
                    <div class="icon-button">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="icon-button">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="profile">
                        <img src="{{ asset('images/profile.jpg') }}" alt="Profile Picture">
                        <span>Profil</span>
                    </div>
                </div>
            </div>
        </div>
    </header> -->

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="success-content">
                <div class="illustration-side">
                    <div class="illustration">
                        <div class="person-rocket">
                            <img src="{{ asset('images/vector-pembayaran.png') }}" alt="Person on Rocket">
                        </div>
                    </div>
                </div>
                <div class="message-side">
                    <h1 class="success-message">
                        Pembayaran<br>
                        Kamu <span class="success-highlight">Berhasil!</span>
                    </h1>
                    <div class="action-button">
                        <a href="#" class="btn-view-event">Lihat Event Saya</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <!-- <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('images/logo-white.png') }}" alt="EDU Volunteer Logo">
                    <span class="logo-text">EDU <span class="volunteer">VOLUNTEER</span></span>
                </div>
                <div class="footer-info">
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Bandung, Indonesia</span>
                    </div>
                    <div class="phone">
                        <i class="fas fa-phone-alt"></i>
                        <span>0821-1234-5678</span>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->
</body>
</html>