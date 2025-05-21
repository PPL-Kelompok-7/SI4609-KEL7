@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">
@endsection

@section('content')
<div class="payment-container">
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

                        <!-- Form hanya untuk upload dan preview -->
                        <form enctype="multipart/form-data">
                            <label class="upload-button">
                                <span class="plus-icon">+</span>
                                <span>Pilih Foto Bukti Bayar (jpg max.10mb)</span>
                                <input type="file" name="proof_of_payment" accept="image/jpeg,image/png" required>
                            </label>
                            <div id="file-info" style="margin-top: 8px; color: #333; font-size: 14px;"></div>
                            <a id="lihat-bukti" href="#" target="_blank" style="display:none; color: #007bff; text-decoration:underline; margin-top:8px;">Lihat Bukti</a>
                        </form>

                        <!-- Tombol redirect -->
                        <a href="{{ url('/pembayaran/berhasil') }}" class="check-status-btn" style="display:inline-block;text-align:center;">
                            Cek Status Pembayaran
                        </a>

                        <script>
                        document.querySelector('input[name="proof_of_payment"]').addEventListener('change', function(e) {
                            const fileInfo = document.getElementById('file-info');
                            const lihatBukti = document.getElementById('lihat-bukti');
                            if (this.files && this.files[0]) {
                                const file = this.files[0];
                                fileInfo.textContent = `File dipilih: ${file.name} (${file.type})`;
                                const url = URL.createObjectURL(file);
                                lihatBukti.href = url;
                                lihatBukti.style.display = 'inline';
                            } else {
                                fileInfo.textContent = '';
                                lihatBukti.style.display = 'none';
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
                        <span class="price">Rp{{ number_format($event->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="ticket-details-card">
            <h2>Detail Tiket</h2>
            <h3 class="event-title">{{ $event->title ?? '-' }}</h3>
            <div class="event-info">
                <div class="info-item">
                    <img src="{{ asset('images/calendar.png') }}" alt="Calendar" class="info-icon">
                    <span>{{ $tanggal ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <img src="{{ asset('images/time.png') }}" alt="Time" class="info-icon">
                    <span>{{ $jam ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <img src="{{ asset('images/location.png') }}" alt="Location" class="info-icon">
                    <span>{{ $event->location ?? '-' }}</span>
                </div>
            </div>
            <hr class="divider">
            <div class="organizer">
                <img src="{{ asset('images/logosmktelkom.png') }}" alt="Telkom School" class="organizer-logo">
                <div class="organizer-info">
                    <p>Diselenggarakan oleh</p>
                    <strong>{{ $event->organizer ?? 'SMK Telkom Bandung' }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
