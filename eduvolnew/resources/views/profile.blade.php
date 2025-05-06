@extends('layouts.app')

@section('content')
<div class="container my-4" style="padding-top: 110px; padding-bottom: 100px;">
    {{-- Profile Header --}}
    <div class="row d-flex align-items-center">
        <div class="col-auto">
            <div class="position-relative">
                <img src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : asset('profile1.png') }}" 
                     alt="Foto Profil" 
                     class="profile-header-photo"
                     style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex flex-column gap-2 mt-3">
                <div class="fs-3 fw-bold text-white">Relawan</div>
                <div class="fs-2 fw-bold" style="color: #69FD8D;">{{ $user->first_name }} {{ $user->last_name }}</div>
                <a href="{{ route('profile.edit') }}" class="btn btn-light btn-sm fw-bold text-primary" style="max-width: 120px;">
                    <i class="fas fa-pencil-alt"></i> Edit Profil
                </a>
                <div class="text-white user-role-location">
                    <div><i class="fas fa-shopping-bag me-2"></i> {{ $user->profession }}</div>
                    <div><i class="fas fa-map-marker-alt me-2"></i> {{ $user->domicile }}</div>
                </div>
            </div>
        </div>
        <div class="col-auto ms-auto mt-3">
            <div class="d-flex gap-5">
                <div class="text-center">
                    <div class="fs-3 fw-bold text-white">Partisipasi</div>
                    <div class="fs-1 fw-bold" style="color: #69FD8D;">0</div>
                </div>
                <div class="text-center">
                    <div class="fs-3 fw-bold text-white">Rating</div>
                    <div class="fs-1 fw-bold" style="color: #69FD8D;">0/5</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab Menu --}}
    <div class="tab-menu my-4">
        <ul class="nav nav-tabs nav-fill" id="profileTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="participasi-tab" data-bs-toggle="tab" data-bs-target="#participasi" type="button" role="tab" aria-controls="participasi" aria-selected="true">Partisipasi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Review</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="milestone-tab" data-bs-toggle="tab" data-bs-target="#milestone" type="button" role="tab" aria-controls="milestone" aria-selected="false">Milestone</button>
            </li>
        </ul>
    </div>

    {{-- Tab Content --}}
    <div class="tab-content" id="profileTabContent">
        {{-- Partisipasi --}}
        <div class="tab-pane fade show active" id="participasi" role="tabpanel" aria-labelledby="participasi-tab">
            <div class="featured-event-header mb-3">
                Featured Event <i class="fas fa-pencil-alt"></i>
            </div>
            <div class="row mb-4 px-3 px-md-4">
                @forelse($events as $event)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100" style="background: rgba(255,255,255,0.05); border: none;">
                            <img src="{{ $event->event_photo ? Storage::url($event->event_photo) : asset('default-event.png') }}" class="card-img-top" alt="Event Banner" style="height: 180px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text mb-1">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}
                                </p>
                                <p class="card-text mb-1">
                                    <i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }}
                                </p>
                                <!-- Rating jika ada -->
                                @if(isset($event->rating))
                                    <span class="badge bg-success">{{ $event->rating }}/5</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-white">Belum ada event yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Review --}}
        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
            <p class="text-white px-3">Belum ada review.</p>
        </div>

        {{-- Milestone --}}
        <div class="tab-pane fade" id="milestone" role="tabpanel" aria-labelledby="milestone-tab">
            <div class="px-3 px-md-4">
                @include('components.profile-milestone')
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Refresh halaman setelah kembali dari edit profile
    if (performance.navigation.type === 2) {
        location.reload(true);
    }
});
</script>
@endpush

@endsection 