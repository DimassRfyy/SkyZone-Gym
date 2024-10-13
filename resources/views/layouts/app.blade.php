<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('before-style')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('output.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fonts/clash-display/clash-display.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <title>@yield('title')</title>
    @stack('after-style')
</head>
<body>
    @yield('content')

    @stack('after-script')
</body>
</html>
