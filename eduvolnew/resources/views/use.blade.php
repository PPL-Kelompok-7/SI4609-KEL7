<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Berikan Voucher</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 8px;
        }
        h1 {
            text-align: center;
        }
        .voucher-info {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        select, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Berikan Voucher</h1>

    <div class="voucher-info">
        <p><strong>Kode:</strong> {{ strtoupper($voucher->code) }}</p>
        <p><strong>Potongan:</strong> {{ $voucher->voucherType->discount_amount }}%</p>
<p><strong>Berlaku sampai:</strong> 
    {{ \Carbon\Carbon::parse($voucher->voucherType->valid_until)->format('d/m/Y') }}
</p>
    </div>

    <form method="POST" action="{{ route('voucher.assign', ['id' => $voucher->id]) }}">
        @csrf
        <label for="user_id">Berikan voucher ini kepada:</label>
        <select name="user_id" id="user_id" required>
            <option value="">-- Pilih Pengguna --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->first_name }}</option>
            @endforeach
        </select>
        <button type="submit">Berikan Voucher</button>
    </form>

    <a href="{{ url()->previous() }}" class="back-link">&larr; Kembali</a>
</body>
</html>
