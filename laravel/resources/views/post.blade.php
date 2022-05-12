@extends('layouts.home')

@php
    $title = $post->post_title
@endphp

@section("title", $title)

@section("content")



<section class="post-content-card">
    @if (Auth::check() && Auth::user()->user_id === $post->author_id)
        <div class="modify-post-header flex gap=1em justify=space-between">
            <a href="{{ route('post.edit', [$post->post_id]); }}" class="">Edit</a>
            <button id="delete_post_button" class="btn-danger" onclick="confirmDelete();">Delete</button>
            
            <form id="delete_post" class="hide" method="POST" action="{{ route('post.delete', [$post->post_id]) }}">
                @csrf
                
                <a onclick="event.preventDefault(); this.closest('form').submit();" 
                href="{{ route('post.delete', [$post->post_id]); }}" 
                class="color=red">DELETE</a>
                <div>Are you sure you want to delete this post?</div>
            </form>
        </div>
    @endif

    <!-- <div class="gap=1em mb=3em">
        <h1 class="post-header">{{ $post->post_title }}</h1>
        <small class="post-description text=center">
            {{ $post->post_description }}
        </small>
    </div> -->
    
    <article class="post-content">
        {{ Illuminate\Mail\Markdown::parse(htmlspecialchars($post->content)) }}
    </article>
</section>

<script src="{{ URL::asset('js/app.js'); }}"></script>
<script src="{{ URL::asset('js/code_handler.js'); }}"></script>


@endsection