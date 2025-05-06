@extends('layouts.main')

@section('title', 'Konfirmasi Pembayaran')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="payment-section">
        <div class="payment-card">
            <div class="payment-content">
                <div class="payment-header">
                    <div class="icon-title-wrapper">
                        <img src="{{ asset('images/tickets.png') }}" alt="Tiket" class="ticket-icon">
                        <div class="payment-title">
                            <h2>Konfirmasi<br>Pembayaran</h2>
                            <p>Dijamin<br>Cepat dan<br>Aman!</p>
                        </div>
                    </div>
                </div>
                <div class="payment-details">
                    <div class="left-aligned-content">
                        <p class="detail-label">Detail Transfer :</p>
                        <div class="bank-info">
                            <h3>Bank Manja</h3>
                            <h2>122-133-144-155</h2>
                            <p>a.n SMK Telkom Bandung</p>
                        </div>
                        <form action="{{ route('payments.uploadProof', $payment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="upload-button">
                                <span class="plus-icon">+</span>
                                <span>Pilih Foto Bukti Bayar (jpg max.10mb)</span>
                                <input type="file" name="proof_of_payment" accept="image/jpeg,image/png" required>
                            </label>
                            <div id="file-info" style="margin-top: 8px; color: #333; font-size: 14px;"></div>
                            <button type="submit" class="check-status-btn">Cek Status Pembayaran</button>
                        </form>
                        <script>
                        document.querySelector('input[name="proof_of_payment"]').addEventListener('change', function(e) {
                            const fileInfo = document.getElementById('file-info');
                            if (this.files && this.files[0]) {
                                const file = this.files[0];
                                fileInfo.textContent = `File dipilih: ${file.name} (${file.type})`;
                            } else {
                                fileInfo.textContent = '';
                            }
                        });
                        </script>
                        @if($payment && $payment->proof_of_payment)
                            <div class="mt-2">
                                <span>Bukti sudah diupload:</span>
                                <a href="{{ asset('storage/' . $payment->proof_of_payment) }}" target="_blank">Lihat Bukti</a>
                            </div>
                        @endif
                    </div>
                    <hr class="divider">
                    <div class="price-info">
                        <span>Harga</span>
                        <span class="price">Rp{{ number_format($payment->amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="ticket-details-card">
            <h2>Detail Tiket</h2>
            <h3 class="event-title">{{ $registration->event->name ?? '-' }}</h3>
            <div class="event-info">
                <div class="info-item">
                    <img src="{{ asset('images/calendar.png') }}" alt="Calendar" class="info-icon">
                    <span>{{ $registration->event->date ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <img src="{{ asset('images/time.png') }}" alt="Time" class="info-icon">
                    <span>{{ $registration->event->time ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <img src="{{ asset('images/location.png') }}" alt="Location" class="info-icon">
                    <span>{{ $registration->event->location ?? '-' }}</span>
                </div>
            </div>
            <hr class="divider">
            <div class="organizer">
                <img src="{{ asset('images/logosmktelkom.png') }}" alt="Telkom School" class="organizer-logo">
                <div class="organizer-info">
                    <p>Diselenggarakan oleh</p>
                    <strong>{{ $registration->event->organizer ?? 'SMK Telkom Bandung' }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection