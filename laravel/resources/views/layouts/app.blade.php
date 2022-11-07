<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/analog.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/tailwind.css'); }}">
    <title>@yield('title') - Tim's Blog</title>
</head>
<body>
    @include('layouts.navigation')
    @yield('content')
</body>
</html>