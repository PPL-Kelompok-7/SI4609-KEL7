@extends('layouts.app')
@include('layouts.sidebar')
@section('content')


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Event Saya</title>
    <link rel="stylesheet" href="{{ asset('css/historykegiatan.css') }}">
    <style>
        .detail-btn {y
            display: flex;
            align-items: center;
            gap: 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            color: #3c28d4;
            padding: 6px 0;
        }

        .detail-btn .icon-eye {
            background-color: #3c28d4;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 48px; margin-left: 300px;">
        <div class="header" style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center;">
            <div class="title-left">
                <span class="star">★</span>
                <span class="title-text"><span class="green">Event</span> Saya</span>
            </div>
            {{-- Search Form --}}
            <div class="search-right" style="display: flex; align-items: center; margin-top: 20px;">
                <form method="GET" action="{{ route('history-kegiatan.index') }}" style="display:flex; align-items:center; gap: 5px;">
                    <input type="text" name="search" placeholder="Cari Nama Event..." value="{{ request('search') }}" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <button type="submit" style="padding: 8px 15px; background-color: #00cc00; color: white; border: 1px solid #00cc00; border-radius: 4px; cursor: pointer;">Cari</button>
                    {{-- Preserve existing filters when searching --}}
                    @if(request()->has('status'))
                        @foreach((array)request('status') as $status)
                            <input type="hidden" name="status[]" value="{{ $status }}">
                        @endforeach
                    @endif
                </form>
            </div>
        </div>

        <div class="filter-box">
            <form method="GET" action="{{ route('history-kegiatan.index') }}" class="filter-left" style="width:100%;display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:15px;">
                    <span class="filter-label">Filter berdasarkan :</span>
                    <label for="ongoing"><input type="checkbox" id="ongoing" name="status[]" value="ongoing" {{ request()->has('status') && in_array('ongoing', (array)request('status')) ? 'checked' : '' }}> On Going</label>
                    <label for="coming"><input type="checkbox" id="coming" name="status[]" value="coming soon" {{ request()->has('status') && in_array('coming soon', (array)request('status')) ? 'checked' : '' }}> Coming Soon</label>
                    <label for="ended"><input type="checkbox" id="ended" name="status[]" value="ended" {{ request()->has('status') && in_array('ended', (array)request('status')) ? 'checked' : '' }}> Ended</label>
                </div>
                <div class="filter-right">
                    {{-- Removed search input from here --}}
                    <button type="submit" class="apply">Terapkan</button>
                    <a href="{{ route('history-kegiatan.index') }}" class="reset">Hapus Filter</a>
                </div>
            </form>
        </div>

        <table class="event-table">
            <thead>
                <tr>
                    <th>Nama Event</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>
                            <a href="{{ route('event.detail', $event->id) }}" class="detail-btn" style="text-decoration:none;">
                                <span class="icon-eye">👁</span>
                                <span>Lihat Detail Event</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- <div class="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('history-kegiatan.index') }}">Event Saya</a>
            </li>
            <li>
                <a href="{{ route('history-pembayaran') }}">History Pembayaran</a>
            </li>
        </ul>
    </div> -->
</body>

</html>
@endsection