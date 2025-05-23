@extends('layouts.app')

@section('head')
    <title>Detail Notifikasi</title>
@endsection

@section('content')
{{-- Specific CSS for this page --}}
    <link rel="stylesheet" href="{{ asset('css/detail_notifikasi_view.css') }}">
    <div class="container">
        <div class="notification-section">
            <h2><i class="fas fa-bell"></i> <span class="text-green">Notifikasi</span> Saya</h2>

            <div class="notification-card">
                <div class="status">Pembayaran Terverifikasi</div>
                <p>Pembayaran untuk Event {{ $payment->registration->event->title }} sudah diverifikasi.</p>

                <div class="event-details">
                    <h3>{{ $payment->registration->event->title }}</h3>
                    <div class="info">
                        <span><i class="fas fa-tag"></i> {{ number_format($payment->amount / 1000, 0) }}k</span>
                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($payment->registration->event->date)->format('d F Y') }}</span>
                        <span class="transaction-code">KODE TRANSAKSI #{{ $payment->id }}</span>
                    </div>
                    <p>Pembayaran via <strong>{{ $payment->paymentMethod->name ?? 'Transfer' }}</strong> pada tanggal {{ \Carbon\Carbon::parse($payment->payment_date)->format('d F Y') }} sudah diverifikasi,</p>
                </div>

                <div class="notification-footer">
                    <span>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d F Y | H.i') }}</span>
                    <button class="close-detail-btn">Tutup Detail</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeButton = document.querySelector('.close-detail-btn');
        if (closeButton) {
            closeButton.addEventListener('click', function () {
                // Redirect to the notifikasi_relawan page using the named route
                window.location.href = "{{ route('notifikasi.relawan') }}";
            });
        }
    });
</script>
@endpush