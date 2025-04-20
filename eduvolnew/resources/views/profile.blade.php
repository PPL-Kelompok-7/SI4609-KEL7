profile.blade.php
@extends('layouts.app')

@section('content')
<div class="container my-4" style="padding-top: 110px; padding-bottom: 100px;">
    {{-- Profile Header --}}
    <div class="row d-flex align-items-center">
        <div class="col-auto">
            <img src="{{ asset('profile1.png') }}" alt="Foto Profil" class="profile-header-photo">
        </div>
        <div class="col-auto">
            <div class="d-flex flex-column gap-2 mt-3">
                <div class="fs-3 fw-bold text-white">Relawan</div>
                <div class="fs-2 fw-bold" style="color: #69FD8D;">Cheryl Lidia Regar</div>
                <button class="btn btn-light btn-sm fw-bold text-primary" style="max-width: 120px;">
                    <i class="fas fa-pencil-alt"></i> Edit Profil
                </button>
                <div class="text-white user-role-location">
                    <div><i class="fas fa-shopping-bag me-2"></i> Mahasiswa</div>
                    <div><i class="fas fa-map-marker-alt me-2"></i> Balikpapan, Kalimantan Timur</div>
                </div>
            </div>
        </div>
        <div class="col-auto ms-auto mt-3">
            <div class="d-flex gap-5">
                <div class="text-center">
                    <div class="fs-3 fw-bold text-white">Partisipasi</div>
                    <div class="fs-1 fw-bold" style="color: #69FD8D;">60</div>
                </div>
                <div class="text-center">
                    <div class="fs-3 fw-bold text-white">Rating</div>
                    <div class="fs-1 fw-bold" style="color: #69FD8D;">4,9/5</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab Menu --}}
    <div class="tab-menu my-4">
        <div class="d-flex justify-content-around fs-5 fw-bold text-white">
            <div>Partisipasi</div>
            <div>Review</div>
            <div>Milestone</div>
        </div>
        <hr>
    </div>

    {{-- Featured Event Header --}}
    <div class="featured-event-header mb-3">
        Featured Event <i class="fas fa-pencil-alt"></i>
    </div>

    {{-- Featured Event Cards --}}
    <div class="row mb-4 px-3 px-md-4">
        {{-- Event 1 --}}
        <div class="col-md-6 mb-3">
            @include('components.event-card', [
                'banner' => 'banner1.png',
                'title' => 'Ngajar Ngoding Selasa #2',
                'rating' => '5/5',
                'date' => '24 Oktober 2024',
                'vendor' => 'vendor.png'
            ])
        </div>

        {{-- Event 2 --}}
        <div class="col-md-6 mb-3">
            @include('components.event-card', [
                'banner' => 'banner2.png',
                'title' => 'Design 101 #4',
                'rating' => '5/5',
                'date' => '4 Mei 2024',
                'vendor' => 'vendor.png'
            ])
        </div>
    </div>
</div>
@endsection