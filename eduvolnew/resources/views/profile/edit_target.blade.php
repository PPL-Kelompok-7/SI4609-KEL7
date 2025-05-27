@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 600px;">
    <div class="card p-4" style="background: #4B36D0; color: #fff; border-radius: 16px; border: 1px solid #fff;">
        <h3 class="mb-4">Edit Target</h3>
        <form action="{{ route('profile.updateTarget') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="target_hours" class="form-label" style="font-size: 1.1em;">Target Hours :</label>
                <input type="number" name="target_hours" id="target_hours" value="{{ old('target_hours', $targetHours) }}" min="1" max="5000" class="form-control w-auto d-inline-block" style="width: 100px; display: inline-block;" required dusk="target-hours-input">
            </div>
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('profile') }}" class="btn btn-outline-light">Cancel</a>
                <button type="submit" class="btn" style="background: #69FD8D; color: #222;" dusk="save-target-btn">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection 