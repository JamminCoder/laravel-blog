@extends('layouts.home')

@php
    $title = $post->post_title
@endphp

@section("title", $title)

@section("content")
<section class="post-content-card">
    @if (Auth::check() && Auth::user()->user_id === $post->author_id)
        <div class="modify-post-header">
            <div class="flex gap-4">
                <a href="{{ route('post.edit', [$post->post_id]); }}" class="">Edit</a>
                <button id="delete_post_button" class="btn-danger" onclick="confirmDelete();">Delete</button>
            </div>

            <form id="delete_post" class="hidden" method="POST" action="{{ route('post.delete', [$post->post_id]) }}">
                @csrf
                <div>Are you sure you want to delete this post?</div>
                
                <a onclick="event.preventDefault(); this.closest('form').submit();" 
                href="{{ route('post.delete', [$post->post_id]); }}" 
                class="color=red">DELETE</a>
            </form>
        </div>
    @endif
    
    <article class="post-content">
        {{ Illuminate\Mail\Markdown::parse(htmlspecialchars($post->content)) }}
    </article>
</section>

<script src="{{ URL::asset('js/app.js'); }}"></script>
<script src="{{ URL::asset('js/code_handler.js'); }}"></script>

@endsection