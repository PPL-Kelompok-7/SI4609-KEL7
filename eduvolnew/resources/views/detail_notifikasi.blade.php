@extends('layouts.app')

@section('head')
    <title>Detail Notifikasi</title>
    {{-- Specific CSS for this page --}}
    <link rel="stylesheet" href="{{ asset('css/detail_notifikasi.css') }}">
    <style>
        html, body {
            height: 100%;
            min-height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

        body {
            display: block !important;
            min-height: 100vh;
            height: auto !important;
        }

        .main-content {
            flex: 1;
            padding-top: 76px;
        }

        .footer-navbar {
            background-color: #0E100F;
            padding: 0.7rem 0;
            margin-top: 2rem;
            color: #FFFFFF;
        }
        
        .footer-navbar img {
            filter: brightness(0) invert(1);
            height: 32px;
            margin-bottom: 0 !important;
        }
        
        .footer-navbar .location-container {
            padding-left: 0;
            padding-right: 0;
            align-items: flex-start;
            justify-content: flex-start;
            margin: 0;
        }
        
        .footer-navbar .location-info {
            margin-bottom: 0 !important;
            margin-top: 0 !important;
        }
        
        .footer-navbar .btn-start {
            background-color: #69FD8D;
            color: #0E100F;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .footer-navbar .btn-start:hover {
            background-color: #50e974;
            transform: translateY(-2px);
        }
        
        .footer-navbar i {
            color: #FFFFFF;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 0;
            }
            .main-content {
                padding-top: 62px;
            }
            .footer-navbar .location-container {
                margin: 1rem 0;
            }
        }

        .nav-profile-photo {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .nav-profile-photo:hover {
            border-color: rgba(255, 255, 255, 0.5);
            transform: scale(1.05);
        }
        .navbar {
            background-color: #4E36E9;
            padding-top: 0.2rem !important;
            padding-bottom: 0.2rem !important;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
            min-height: 64px;
            display: flex;
            align-items: center;
        }
        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding-top: 4px !important;
            padding-bottom: 4px !important;
        }
        .navbar-nav .nav-link:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        .footer-navbar,
        .footer-navbar .location-info,
        .footer-navbar .btn-start,
        .footer-navbar span,
        .footer-navbar a {
            color: #fff !important;
        }
        .navbar .navbar-nav .nav-link,
        .navbar .navbar-brand,
        .navbar .d-flex.align-items-center {
            padding-top: 6px;
            padding-bottom: 6px;
        }
        .footer-navbar .row.align-items-center {
            align-items: flex-end !important;
        }
        .footer-navbar .location-info,
        .footer-navbar .btn-start {
            margin-top: 6px;
            margin-bottom: 6px;
        }
        .footer-navbar .location-container {
            gap: 2px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="notification-section">
            <h2><i class="fas fa-bell"></i> Notifikasi Saya</h2>

            <div class="notification-card">
                <div class="status">Pembayaran Terverifikasi</div>
                <p>Pembayaran untuk Event A sudah diverifikasi.</p>

                <div class="event-details">
                    <h3>Ngajar Ngoding Selasa #6</h3>
                    <div class="info">
                        <span><i class="fas fa-tag"></i> 250k</span>
                        <span><i class="fas fa-calendar-alt"></i> 22 Oktober 2025</span>
                        <span class="transaction-code">KODE TRANSAKSI #34348234</span>
                    </div>
                    <p>Pembayaran via <strong>transfer</strong> pada tanggal 13 Mei 2025 sudah diverifikasi,</p>
                </div>

                <div class="notification-footer">
                    <span>14 Mei 2025 | 13.00</span>
                    <button class="close-detail-btn">Tutup Detail</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Specific JS for this page --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/api/notifikasi/relawan')
                .then(response => response.json())
                .then(data => {
                    const notifList = document.getElementById('volunteer-notif-list');
                    notifList.innerHTML = ''; // Clear previous content
                    if (data.length === 0) {
                        notifList.innerHTML = '<div style="color:#fff;opacity:0.7;">Belum ada notifikasi pembayaran terverifikasi.</div>';
                    } else {
                        data.forEach(notif => {
                            const notifCard = document.createElement('div');
                            notifCard.classList.add('notif-card');
                            
                            // Check if registration and event exist before accessing properties
                            const eventTitle = notif.registration && notif.registration.event ? notif.registration.event.title : 'Unknown Event';
                            
                            // Use notif.payment_date if that's the correct field for payment completion date
                            // Assuming updated_at is the completion timestamp for now based on screenshot
                            const notificationDate = new Date(notif.updated_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                            const notificationTime = new Date(notif.updated_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                            notifCard.innerHTML = `
                                <div class="notif-title">Pembayaran Terverifikasi</div>
                                <div class="notif-desc">Pembayaran untuk Event ${eventTitle} sudah diverifikasi.</div>
                                <div class="notif-meta">${notificationDate} | ${notificationTime} <a href="/payments/${notif.id}" class="notif-detail">Lihat Detail</a></div>
                            `;
                            notifList.appendChild(notifCard);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching volunteer notifications:', error);
                    document.getElementById('volunteer-notif-list').innerHTML = '<div style="color:#fff;opacity:0.7;">Gagal memuat notifikasi.</div>';
                });
        });
    </script>
@endsection