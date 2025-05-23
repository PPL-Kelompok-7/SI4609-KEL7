@extends('layouts.app')

@section('head')
    {{-- Keep specific CSS for this page --}}
@endsection

@section('content')
    {{-- The main content area that was inside the 'flex:1' div --}}
    <link rel="stylesheet" href="{{ asset('css/notifikasi_relawan.css') }}">
    <div class="main-content">
        <div class="notif-header" style="display: flex; align-items: center; gap: 12px;">
            <img src="{{ asset('images/notifikasibel.png') }}" alt="Bell Icon" style="width: 40px; height: 40px;">
            <span class="notif-title">Notifikasi <span>Saya</span></span>
        </div>
        <div class="notif-tabs">
            <span class="active">Belum Dibaca</span>
            <span>Semua</span>
        </div>
        <div class="notif-list" id="volunteer-notif-list">
            {{-- Verified payment notifications for volunteers will be loaded here by JavaScript --}}
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Keep specific JS for this page --}}
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