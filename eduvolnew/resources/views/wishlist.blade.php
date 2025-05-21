@extends('layouts.app')
@include('layouts.sidebar')

@section('css')
<link rel="stylesheet" href="{{ asset('css/wishlist.css') }}">
@endsection

@section('content')
<div class="wishlist-container with-sidebar">
    <div class="wishlist-header" style="display: flex; align-items: center; gap: 10px; margin-left: 24px;">
        <span class="wishlist-star" style="display: flex; align-items: center;">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <polygon points="16,4 20,13 30,13 22,19 25,28 16,22 7,28 10,19 2,13 12,13" fill="white"/>
            </svg>
        </span>
        <span class="wishlist-title"><span class="wishlist-title-green">Event Favorit</span> Saya</span>
    </div>
    <!-- <div class="wishlist-desc">Daftar event yang ditandai sebagai favorit</div> -->
    <div class="wishlist-grid">
        @for ($i = 0; $i < 4; $i++)
        <div class="wishlist-card">
            <div class="wishlist-card-img-wrapper">
                <img src="/logo0.png" alt="Logo" class="wishlist-card-logo">
                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=400&q=80" alt="Event" class="wishlist-card-img">
                <div class="wishlist-card-label">NGAJAR NGODING</div>
            </div>
            <div class="wishlist-card-bottom">
                <div class="wishlist-card-heart">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <circle cx="20" cy="20" r="20" fill="white"/>
                        <path d="M20 30C19.47 30 18.93 29.83 18.51 29.48C15.41 26.29 8 20.91 8 15.67C8 12.24 10.91 9.33 14.33 9.33C16.16 9.33 17.89 10.24 18.83 11.73C19.77 10.24 21.5 9.33 23.33 9.33C26.75 9.33 29.66 12.24 29.66 15.67C29.66 20.91 22.25 26.29 19.15 29.48C18.73 29.83 18.19 30 17.67 30H20Z" fill="#F44336"/>
                    </svg>
                </div>
                <div class="wishlist-card-info">
                    <div class="wishlist-card-title">Ngajar Ngoding Selasa #6</div>
                    <div class="wishlist-card-meta">
                        <span><i class="fa fa-tag"></i> 250K</span>
                        <span><i class="fa fa-calendar"></i> 22 Oktober 2023</span>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
