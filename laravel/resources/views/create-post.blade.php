@extends('layouts.app')

@section("title", "New Post")

@section("content")

<div class="flex flex-col items-center px-1 mt-4">
    <form class="flex flex-col align-center" id="markdown_form" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $post->post_id }}" name="post_id"/>
        <div class="flex items-center flex-col gap-4 mb-12">
            <label for="post_title">Post Title</label>    
            <input type="text" name="post_title" id="post_title" class="font-bold text-2xl text-center" placeholder="Title">
            
            <br>

            <label for="post_description">Post Description</label>
            <input type="text" name="post_description" id="post_description" class="font-description text-center text-sm max-w-[60ch]" placeholder="Describe your post breifly">
        </div>

        <textarea name="post_content" id="post_content"></textarea>

        <button class="p-2 bg-green-500 rounded">Submit</button>
    </form>

    <script src="{{ URL::asset('js/handle_file_upload.js'); }}"></script>
</div>

@endsection