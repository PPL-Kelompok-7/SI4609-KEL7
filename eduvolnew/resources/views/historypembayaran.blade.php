@extends('layouts.main')

@section('title', 'History Pembayaran')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/historybayar.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="main-container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li>
                <a href="#">Event Saya</a>
                </li>
                <li class="active">
                <a href="#">History Pembayaran</a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="title-area">
                <span class="star">★</span>
                <span class="title-text"><span class="green">History</span> Pembayaran Saya</span>
            </div>
            <div class="filter-box">
                <div class="filter-left">
                    <span class="filter-label">Filter berdasarkan :</span>
                    <label for="paid"><input type="checkbox" id="paid" name="status" value="Paid"> Paid</label>
                    <label for="unpaid"><input type="checkbox" id="unpaid" name="status" value="Unpaid"> Unpaid</label>
                    <label for="verification"><input type="checkbox" id="verification" name="status" value="On Verification"> On Verification</label>
                </div>
                <div class="filter-right">
                    <button class="apply">Terapkan</button>
                    <button class="reset">Hapus Filter</button>
                </div>
            </div>
            <table class="event-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Nama Event</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->status_label }}</td>
                            <td>{{ $payment->registration->event->name ?? '-' }}</td>
                            <td>
                                @if($payment->status_label === 'Unpaid')
                                    <a href="{{ route('payments.show', $payment->registration_id) }}" class="detail-btn">
                                        <span class="icon-eye"><i class="fas fa-eye"></i></span>
                                        <span>Lanjutkan Bayar</span>
                                    </a>
                                @else
                                    <a href="{{ route('payments.show', $payment->registration_id) }}" class="detail-btn">
                                        <span class="icon-eye"><i class="fas fa-eye"></i></span>
                                        <span>Lihat Detail Bayar</span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection