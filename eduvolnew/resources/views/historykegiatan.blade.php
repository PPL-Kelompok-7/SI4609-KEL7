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
    <div class="container" style="margin-top: 48px; margin-left: 240px;">
        <div class="header" style="margin-bottom: 40px;">
            <div class="title-left">
                <span class="star">★</span>
                <span class="title-text"><span class="green">Event</span> Saya</span>
            </div>
            <div class="status-summary">
                <div class="status-box">
                    <span class="dot green"></span>
                    <div><strong>2</strong><br>On Going</div>
                </div>
                <div class="status-box">
                    <span class="dot orange"></span>
                    <div><strong>1</strong><br>Coming Soon</div>
                </div>
                <div class="status-box">
                    <span class="dot grey"></span>
                    <div><strong>10</strong><br>Ended</div>
                </div>
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
                    <button type="submit" class="apply">Terapkan</button>
                    <a href="{{ route('history-kegiatan.index') }}" class="reset">Hapus Filter</a>
                </div>
            </form>
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
                @foreach($events as $event)
                    <tr>
                        <td>
                            @php
                                $statusName = strtolower(optional($event->status)->name ?? '');
                            @endphp
                            @if($statusName == 'ongoing')
                                <span class="dot green"></span>
                            @elseif($statusName == 'published' || $statusName == 'coming soon')
                                <span class="dot orange"></span>
                            @elseif($statusName == 'completed' || $statusName == 'ended')
                                <span class="dot grey"></span>
                            @else
                                <span class="dot"></span>
                            @endif
                        </td>
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
</body>

</html>
@endsection