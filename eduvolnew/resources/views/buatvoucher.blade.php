<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Voucher Baru</title>
    <link rel="stylesheet" href="{{ asset('css/buatvoucher.css') }}">
</head>
<body>
<div class="container">
    <div class="voucher-card">
        <h2>Tambahkan Voucher</h2>
        <p class="subtitle">Silahkan isi data untuk kegiatan volunteer Anda</p>

        <!-- Tempat pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tempat pesan error -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vouchers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Voucher :</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Voucher</label>
                <textarea name="description" class="form-control" placeholder="">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="discount_amount">Jumlah Potongan (Rp)</label>
                <input type="number" name="discount_amount" class="form-control" value="{{ old('discount_amount') }}" required min="0">
            </div>

            <div class="form-group">
                <label for="valid_until">Tanggal Berlaku Sampai</label>
                <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until') }}" required>
            </div>

            <div class="form-group">
                <label for="generate_count">Jumlah Kode Voucher</label>
                <select name="generate_count" class="form-control" required>
                    <option value="10" {{ old('generate_count') == 10 ? 'selected' : '' }}>10 Kode</option>
                    <option value="15" {{ old('generate_count') == 15 ? 'selected' : '' }}>15 Kode</option>
                    <option value="20" {{ old('generate_count') == 20 ? 'selected' : '' }}>20 Kode</option>
                </select>
            </div>

            <div class="button-group">
                <button type="button" class="btn btn-cancel" onclick="history.back()">Batal</button>
                <button type="submit" class="btn btn-primary">Tambahkan Voucher</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>