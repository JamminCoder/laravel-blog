@extends('layouts.app')

@section('title', "Edit Post")
@section('content')

<div class="flex flex-col align=center px=1 mt=4">
    <section class="card shadow mx=0.2em mb=2em post-content-card">
        <form id="markdown_form" action="{{ route('post.update'); }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex align=center flex-col gap=1em mb=3em p=1em">
                <h1 class="text=center d=flex flex-col">
                    <label for="post_title">Title</label><br>
                    <input type="text" id="post_title" name="post_title" value="{{ $post->post_title }}">
                    
                </h1>
                
                <small class="post-description text=center">
                    <label for="post_description">Description</label><br>
                    <input type="text" id="post_description" name="post_description" value="{{ $post->post_description }}">
                </small>

                
            </div>
            <input type="hidden" id='post_id' name="post_id" value="{{ $post->post_id }}">
            <textarea ondrop="dropHandler(event);"  class="width=100% p=1" name="content" id="content">{{ $post->content }}</textarea>
            <button>Save</button>
        </form>
        <a href="{{ route('post.display', [$post->post_id]) }}">Cancel</a>
        <input type="file" id="upload_image" name="upload_image">

    </section>
    <script src="{{ URL::asset('js/handle_file_upload.js'); }}"></script>
    <script src="{{ URL::asset('js/app.js'); }}"></script>
</div>



@endsection