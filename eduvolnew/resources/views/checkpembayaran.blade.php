@extends('layouts.app')

@section('title', 'Landing Page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/checkpembayaran.css') }}">
@endsection

@section('content')
<main class="main-content">
    <div class="success-container">
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
                    Kamu <span class="success-highlight">Sedang Ditinjau Admin</span>
                </h1>
                <div class="action-button">
                    <a href="{{ route('history-kegiatan.index') }}" class="btn-view-event">Lihat Status Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection