

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
            
            <div class="table-row">
                <div class="status belum-dinilai">Belum Dinilai</div>
                <div class="nama-relawan">Cheryl Regar</div>
                <div class="nama-event">Ngajar Ngoding Selasa #6 Dasar Bahasa Pemrograman PHP</div>
                <div class="aksi">
                    <button class="btn-rating">
                        <i class="fas fa-star"></i> Berikan Rating
                    </button>
                    <button class="btn-profile">
                        <i class="fas fa-eye"></i> Lihat Profil
                    </button>
                </div>
            </div>
            
            <div class="table-row">
                <div class="status sudah-dinilai">Sudah Dinilai</div>
                <div class="nama-relawan">Selsya Nabila</div>
                <div class="nama-event">Ngajar Ngoding Selasa #6 Dasar Bahasa Pemrograman PHP</div>
                <div class="aksi">
                    <button class="btn-rating disabled">
                        <i class="fas fa-star"></i> Berikan Rating
                    </button>
                    <button class="btn-profile">
                        <i class="fas fa-eye"></i> Lihat Profil
                    </button>
                </div>
            </div>
            
            <div class="table-row">
                <div class="status belum-dinilai">Belum Dinilai</div>
                <div class="nama-relawan">Danit Ramadani</div>
                <div class="nama-event">Ngajar Ngoding Selasa #6 Dasar Bahasa Pemrograman PHP</div>
                <div class="aksi">
                    <button class="btn-rating">
                        <i class="fas fa-star"></i> Berikan Rating
                    </button>
                    <button class="btn-profile">
                        <i class="fas fa-eye"></i> Lihat Profil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingButtons = document.querySelectorAll('.btn-rating:not(.disabled)');
            
            ratingButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Implementasi untuk membuka modal rating atau redirect ke halaman rating
                    alert('Membuka form rating untuk relawan');
                });
            });
            
            const profileButtons = document.querySelectorAll('.btn-profile');
            
            profileButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Implementasi untuk melihat profil relawan
                    alert('Membuka profil relawan');
                });
            });
        });
    </script>
</body>
</html>