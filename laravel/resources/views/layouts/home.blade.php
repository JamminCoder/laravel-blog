<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hello! Welcome to my blog!
     I made this blog to showcase some of the web development skills I picked up, as well as to host website redesigns for my resume.">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ URL::asset('css/app.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/flex.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/analog.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/tailwind.css'); }}">
    <title>@yield('title') - Tim's Blog</title>
</head>
<body>
    @include('layouts.navigation')
    <div class="blog-wrapper">   
        @yield('content')
    </div>

    <script src="{{ URL::asset('js/app.js') }}"></script>
</body>
</html>