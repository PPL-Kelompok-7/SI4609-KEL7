@extends('layouts.main')

@section('title', 'Landing Page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
@endsection

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran - EduVolunteer</title>
    <link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <!-- <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="{{ asset('images/EDUVOL LOGO 1.png') }}" alt="EduVolunteer" class="logo">
            </div>
            
            <div class="nav-links">
                <a href="#" class="nav-link">Beranda</a>
                <a href="#" class="nav-link active">Agenda</a>
                <a href="#" class="nav-link">Partner Kami</a>
                <a href="#" class="nav-link">Relawan Kami</a>
            </div>
            
            <div class="profile-section">
                <button class="icon-button">
                    <img src="{{ asset('images/menu-icon.svg') }}" alt="Menu" class="icon">
                </button>
                <button class="icon-button">
                    <img src="{{ asset('images/notification-icon.svg') }}" alt="Notifikasi" class="icon">
                </button>
                <div class="profile">
                    <img src="{{ asset('images/profile-pic.jpg') }}" alt="Profil" class="profile-pic">
                    <span class="profile-text">Profil</span>
                </div>
            </div>
        </div>
    </nav> -->

    <!-- Main Content -->
    <div class="container">
        <div class="payment-section">
            <!-- Payment Card -->
            <div class="payment-card">
                <div class="payment-content">
                    <div class="payment-header">
                        <div class="icon-title-wrapper">
                            <img src="{{ asset('images/tickets.png') }}" alt="Tiket" class="ticket-icon">
                            <div class="payment-title">
                                <h2>Konfirmasi<br>Pembayaran</h2>
                                <p>Dijamin<br>Cepat dan<br>Aman!</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="payment-details">
                        <div class="left-aligned-content">
                            <p class="detail-label">Detail Transfer :</p>
                            
                            <div class="bank-info">
                                <h3>Bank Manja</h3>
                                <h2>122-133-144-155</h2>
                                <p>a.n SMK Telkom Bandung</p>
                            </div>
                            
                            <div class="upload-button">
                                <button type="button" id="uploadBtn">
                                    <span class="plus-icon">+</span>
                                    Pilih Foto Bukti Bayar (jpg max.10mb)
                                </button>
                                <input type="file" id="paymentProof" accept="image/jpeg" hidden>
                            </div>
                        </div>

                        <hr class="divider">
                        
                        <div class="price-info">
                            <span>Harga</span>
                            <span class="price">Rp210.000</span>
                        </div>
                        
                        <button type="button" class="check-status-btn">Cek Status Pembayaran</button>
                    </div>
                </div>
            </div>
            
            <!-- Ticket Details Card -->
            <div class="ticket-details-card">
                <h2>Detail Tiket</h2>
                
                <h3 class="event-title">Ngajar Ngoding Selasa #6<br>Dasar Bahasa<br>Pemrograman PHP</h3>
                
                <div class="event-info">
                    <div class="info-item">
                        <img src="{{ asset('images/calendar.png') }}" alt="Calendar" class="info-icon">
                        <span>22 Oktober 2025</span>
                    </div>
                    
                    <div class="info-item">
                        <img src="{{ asset('images/time.png') }}" alt="Time" class="info-icon">
                        <span>09:00 - 14:00</span>
                    </div>
                    
                    <div class="info-item">
                        <img src="{{ asset('images/location.png') }}" alt="Location" class="info-icon">
                        <span>Ruangan Multimedia SMK Telkom Bandung</span>
                    </div>
                </div>
                
                <hr class="divider">
                
                <div class="organizer">
                    <img src="{{ asset('images/logosmktelkom.png') }}" alt="Telkom School" class="organizer-logo">
                    <div class="organizer-info">
                        <p>Diselenggarakan oleh</p>
                        <strong>SMK Telkom Bandung</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!-- <footer class="main-footer">
        <div class="footer-content">
            <img src="{{ asset('images/eduvolunteer-white.svg') }}" alt="EduVolunteer" class="footer-logo">
            
            <div class="footer-contact">
                <div class="contact-item">
                    <img src="{{ asset('images/location-icon-white.svg') }}" alt="Location" class="contact-icon">
                    <span>Bandung, Indonesia</span>
                </div>
                <div class="contact-item">
                    <img src="{{ asset('images/phone-icon-white.svg') }}" alt="Phone" class="contact-icon">
                    <span>0821-1234-5678</span>
                </div>
            </div>
        </div>
    </footer> -->

    <!-- Scripts -->
    <script>
        document.getElementById('uploadBtn').addEventListener('click', function() {
            document.getElementById('paymentProof').click();
        });
        
        document.getElementById('paymentProof').addEventListener('change', function() {
            // Handle file upload logic here
            const fileName = this.files[0]?.name;
            if (fileName) {
                alert(`File selected: ${fileName}`);
                // Additional logic for uploading the file
            }
        });
    </script>
</body>
</html>