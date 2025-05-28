@extends('layouts.mitra')

@section('title', 'Rating Relawan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/ratingrel.css') }}">
@endsection

@section('content')

<div class="container">
    <div class="rating-table">
        <div class="table-header">
            <div class="header-status">Status</div>
            <div class="header-nama">Nama Relawan</div>
            <div class="header-event">Nama Event</div>
            <div class="header-aksi">Aksi</div>
        </div>

        @foreach ($ratings as $rating)
            <div class="table-row">
                <div class="status {{ $rating->status == 'Sudah Dinilai' ? 'sudah-dinilai' : 'belum-dinilai' }}">
                    {{ $rating->status }}
                </div>
                <div class="nama-relawan">{{ $rating->full_name }}</div>
                <div class="nama-event">{{ $rating->event_title }}</div>
                <div class="aksi">
                    @if ($rating->status == 'Belum Dinilai')
                        <a href="{{ route('formrating', ['relawan_id' => $rating->user_id, 'event_id' => $rating->event_id]) }}">
                            <button class="btn-rating">
                                <i class="fas fa-star"></i> Berikan Rating
                            </button>
                        </a>
                    @else
                        <button class="btn-rating disabled" disabled>
                            <i class="fas fa-star"></i> Sudah Dinilai
                        </button>
                    @endif


                    <a href="{{ route('lihatreview', ['relawan_id' => $rating->user_id, 'event_id' => $rating->event_id]) }}">
                        <button class="btn-profile">
                            <i class="fas fa-eye"></i> Lihat Ulasan
                        </button>
                    </a>
                    
                </div>
            </div>
        @endforeach

    </div>
</div>

<script>
    // Nonaktifkan alert karena sudah pakai link langsung
    // Jika ingin pakai modal atau AJAX, bisa dikembangkan nanti
</script>

@endsection
