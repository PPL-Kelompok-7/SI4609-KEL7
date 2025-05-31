@extends('layouts.mitra')

@section('title', 'Lihat Ulasan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/ratingrel.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="review-card">
        <h2>Ulasan untuk Relawan: {{ $review->full_name }}</h2>
        <p><strong>Event:</strong> {{ $review->event_title }}</p>
        <p><strong>Rating:</strong> {{ $review->rating }} / 10</p>
        <p><strong>Ulasan:</strong> {{ $review->ulasan }}</p>
        <p><strong>Diberikan pada:</strong> {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y, H:i') }}</p>
        <a href="{{ route('ratingrelawan') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
</div>
@endsection
