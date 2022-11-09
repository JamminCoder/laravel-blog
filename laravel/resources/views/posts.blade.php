@extends('layouts.home')

@section('title', 'Home')

@section('content')


    @if (count($posts) >= 1)
    <div class="w-[30em]">
        <h1 class="text-3xl mb-8 font-semibold">Blog Posts.</h1>

        <!-- Load all the blog post previews here -->
        <div class="posts">
            @include('layouts.render-posts', ['posts' => $posts])
        </div>
    </div>
    
    @else
        <h1 class="text-2xl mb-8 font-semibold">No posts yet.</h1>

    @endif

@endsection