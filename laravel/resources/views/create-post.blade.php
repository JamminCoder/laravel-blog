@extends('layouts.app')

@section("title", "New Post")

@section("content")

<div class="flex flex-col align=center">
<form id="markdown_form" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col align=center">
        @csrf
        <div class="blog-header flex align=center flex-col gap=1em mb=3em">
            <label for="post_title">Post Title</label>    
            <input type="text" name="post_title" id="post_title" class="one-line-input font-weight=bold font-size=2em text=center" placeholder="Title">
            
            <br>
            <label for="post_description">Post Description</label>
            <input type="text" name="post_description" id="post_description" class="one-line-input font-description text=center font-size=0.8em max-w=60ch" placeholder="Describe your post breifly">
        </div>

        <button>Continue</button>
    </form>

    <script src="{{ URL::asset('js/handle_file_upload.js'); }}"></script>
</div>

@endsection