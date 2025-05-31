<!DOCTYPE html>
<html>
<head>
    <title>Top 3 Users by Event Participation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li {
            padding: 10px;
            background: #f2f2f2;
            margin-bottom: 8px;
            border-radius: 5px;
        }
        .event-count {
            font-weight: bold;
            color: #007BFF;
            float: right;
        }
    </style>
</head>
<body>
    <h1>Top 3 Users by Event Participation</h1>
    <ul>
        @foreach ($topUsers as $user)
            <li>
                {{ $user->full_name }}
                <span class="event-count">{{ $user->total_events }} event</span>
            </li>
        @endforeach
    </ul>
</body>
</html>
