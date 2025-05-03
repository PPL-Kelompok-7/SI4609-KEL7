@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Volunteer Rating Details</h2>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <h5>Event</h5>
                        <p class="lead">{{ $relawanRating->event->title }}</p>
                    </div>

                    <div class="mb-3">
                        <h5>Volunteer</h5>
                        <p>{{ $relawanRating->volunteer->first_name }} {{ $relawanRating->volunteer->last_name }}</p>
                    </div>

                    <div class="mb-3">
                        <h5>Rated By</h5>
                        <p>{{ $relawanRating->rater->first_name }} {{ $relawanRating->rater->last_name }}</p>
                    </div>

                    <div class="mb-3">
                        <h5>Rating</h5>
                        <div class="rating-display">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $relawanRating->rating ? 'text-warning' : 'text-secondary' }}"></i>
                            @endfor
                        </div>
                    </div>

                    <div class="mb-3">
                        <h5>Comment</h5>
                        <p>{{ $relawanRating->comment ?: 'No comment provided.' }}</p>
                    </div>

                    <div class="mb-3">
                        <h5>Date</h5>
                        <p>{{ $relawanRating->created_at->format('F d, Y h:i A') }}</p>
                    </div>

                    <div class="mt-4">
                        @can('update', $relawanRating)
                            <a href="{{ route('relawan-ratings.edit', $relawanRating) }}" class="btn btn-primary">Edit Rating</a>
                        @endcan
                        <a href="{{ route('relawan-ratings.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rating-display {
    font-size: 24px;
}
</style>
@endsection 