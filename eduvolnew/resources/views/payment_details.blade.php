@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment-details.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>Detail Pembayaran</h1>

    <div class="card">
        <div class="card-header">
            Detail Pembayaran
        </div>
        <div class="card-body">
            <p><strong>Nama Event:</strong> {{ $payment->registration->event->title ?? '-' }}</p>
            <p><strong>Status Pembayaran:</strong> {{ $payment->paymentStatus->name ?? '-' }}</p>
            <p><strong>Jumlah:</strong> Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $payment->paymentMethod->name ?? '-' }}</p>
            <p><strong>Tanggal Pembayaran:</strong> {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->translatedFormat('d F Y H:i') : '-' }}</p>

            @if($payment->proof_of_payment)
                <h3>Bukti Pembayaran:</h3>
                <img src="{{ asset('storage/' . $payment->proof_of_payment) }}" alt="Bukti Pembayaran" style="max-width: 100%; height: auto;">
            @else
                <p>Belum ada bukti pembayaran diupload.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('history-pembayaran') }}" class="btn btn-secondary mt-3">Kembali ke Riwayat Pembayaran</a>
</div>
@endsection 