<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Berikan Voucher</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 8px;
        }
        h1 {
            text-align: center;
        }
        .voucher-info, form {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        select, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 1rem;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #555;
            text-decoration: none;
        }
        .top-volunteers-section {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .top-volunteers-section h3 {
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 1.2rem;
        }
        table.top-volunteers-table {
            border-collapse: collapse;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
        table.top-volunteers-table th,
        table.top-volunteers-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        table.top-volunteers-table th {
            background-color: #f0f0f0;
        }
        table.top-volunteers-table td:nth-child(2) {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Berikan Voucher</h1>

    <div class="voucher-info">
        <p><strong>Kode:</strong> {{ strtoupper($voucher->code) }}</p>
        <p><strong>Potongan:</strong> Rp {{ number_format($voucher->voucherType->discount_amount, 0, ',', '.') }}</p>
        <p><strong>Berlaku sampai:</strong> 
            {{ \Carbon\Carbon::parse($voucher->voucherType->valid_until)->format('d/m/Y') }}
        </p>
    </div>

    <div class="top-volunteers-section">
        <h3>Relawan Teraktif</h3>
        <table class="top-volunteers-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jumlah Event</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topVolunteers as $volunteer)
                <tr>
                    <td>{{ $volunteer->full_name }}</td>
                    <td>{{ $volunteer->event_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
