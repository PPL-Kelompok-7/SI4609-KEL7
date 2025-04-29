@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Add New Rating</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('event-ratings.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="event_id" class="form-label">Event</label>
                            <select name="event_id" id="event_id" class="form-control @error('event_id') is-invalid @enderror" required>
                                <option value="">Select Event</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                        {{ $event->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('event_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="rating">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} class="@error('rating') is-invalid @enderror">
                                    <label for="rating{{ $i }}">☆</label>
                                @endfor
                            </div>
                            @error('rating')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea name="comment" id="comment" rows="4" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit Rating</button>
                            <a href="{{ route('event-ratings.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
}

.rating input {
    display: none;
}

.rating label {
    cursor: pointer;
    font-size: 30px;
    color: #ddd;
    margin: 0 2px;
}

.rating input:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
    color: #ffd700;
}
</style>
@endsection 