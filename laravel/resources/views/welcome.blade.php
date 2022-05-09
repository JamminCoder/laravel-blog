@extends('layouts.home')

@section('title', 'Home')

@section('content')

<main class="py=4em flex flex-wrap flex-col align=center">
    
    <h1 class="font-header mb=2em px=0.5em">Check out my blog posts!</h1>

    <!-- Load all the blog post previews here -->
    <div class="posts w=90% flex flex-col align=center">
        @include('layouts.render-posts', ['posts' => $posts])
    </div>
</main>

@endsection