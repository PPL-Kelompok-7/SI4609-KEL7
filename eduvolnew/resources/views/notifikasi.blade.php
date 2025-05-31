@extends('layouts.mitra')

@section('title', 'Notifikasi Saya')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/notifikasi.css') }}">
@endsection

@section('content')
    <div class="main-content">
        <div class="notif-header" style="display: flex; align-items: center; gap: 12px;">
            <img src="{{ asset('images/notifikasibel.png') }}" alt="Bell Icon" style="width: 40px; height: 40px;">
            <span class="notif-title">Notifikasi <span>Saya</span></span>
        </div>
        <div class="notif-tabs">
            <span class="active">Belum Dibaca</span>
            <span>Semua</span>
        </div>
        <div class="notif-list">
            @foreach($notifications as $notif)
                <div class="notif-card">
                    <div class="notif-title">Pendaftaran Relawan Baru</div>
                    <div class="notif-desc">Relawan <b>{{ $notif->volunteer_name }}</b> telah mendaftar pada event <b>{{ $notif->event_title }}</b>.</div>
                    <div class="notif-meta">{{ $notif->created_at->format('d M Y') }} | {{ $notif->created_at->format('H:i') }} <a href="{{ url('/event-detail/'.$notif->event_id) }}" class="notif-detail">Lihat Detail</a></div>
                </div>
            @endforeach
            @if($notifications->isEmpty())
                <div style="color:#fff;opacity:0.7;">Belum ada notifikasi baru.</div>
            @endif
        </div>
    </div>
@endsection 