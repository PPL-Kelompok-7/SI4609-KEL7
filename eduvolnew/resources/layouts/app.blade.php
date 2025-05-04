<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduVolunteer')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('custom-css')
</head>
<body>
    <div class="main-container">
        @yield('content')
    </div>

    @yield('custom-js')
</body>
</html>
