@extends('layouts.app')

@section('title', 'Rating Saya')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviewsaya.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="main-container">
    @include('layouts.sidebar')
    <div class="content">
        <div class="title-area">
            <h1>Rating Saya</h1>
        </div>

        <div class="table-container">
            <table class="voucher-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Nama Event</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td>
                                <span class="status-badge {{ $review->status == 'Sudah Dinilai' ? 'used' : 'unused' }}">
                                    {{ $review->status }}
                                </span>
                            </td>
                            <td class="event-name">{{ $review->event_title }}</td>
                            <td>
                            <form action="{{ route('ratingsaya.show', ['event_id' => $review->event_id]) }}" method="GET">
                                <button type="submit" class="voucher-button info" data-dusk="lihat-rating-{{ $loop->index }}">
                                    Lihat Rating
                                </button>
                            </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: #666;">
                                Belum ada rating yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection