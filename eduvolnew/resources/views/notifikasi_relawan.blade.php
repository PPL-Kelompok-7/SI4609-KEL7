@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/notifikasi_relawan.css') }}">
@endsection

@section('content')
<div class="container py-4">
    <h1 class="mb-4">
        <i class="fas fa-bell me-2"></i> <span class="text-green">Notifikasi</span> Saya
    </h1>

    <div class="notification-tabs">
        <div class="notification-tab active">Belum Dibaca</div>
        <div class="notification-tab">Semua</div>
    </div>

    <div class="notification-list">
        @forelse ($payments as $payment)
        <div class="notification-item">
            <h5>Pembayaran Terverifikasi</h5>
            <p>Pembayaran untuk Event {{ $payment->registration->event->title }} sudah diverifikasi.</p>
            <div class="notification-meta">
                <span>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d Mei Y | H.i') }}</span>
                <a href="{{ route('payments.show', $payment->id) }}">Lihat Detail</a>
            </div>
        </div>
        @empty
        <div style="color:#fff;opacity:0.7;">Belum ada notifikasi pembayaran terverifikasi.</div>
        @endforelse
    </div>
</div>
@endsection 