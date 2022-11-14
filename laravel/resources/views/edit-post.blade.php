@extends('layouts.app')

@section('title', "Edit Post")
@section('content')

<div class="grid place-content-center px-1 mt-4">
    <form class="max-w-[30rem] w-[100%]" id="markdown_form" action="{{ route('post.update'); }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex align-center flex-col gap-4 mb-[3em] p-[1em]">
            <input class="bg-[#1e1e1e] font-bold text-2xl border-x-0 border-t-0 border-b-slate-700" type="text" id="post_title" name="post_title" value="{{ $post->post_title }}">

            <input class="bg-[#1e1e1e] font-bold text-2xl border-x-0 border-t-0 border-b-slate-700" type="text" id="post_description" name="post_description" value="{{ $post->post_description }}">

        </div>

        <input type="hidden" id='post_id' name="post_id" value="{{ $post->post_id }}">
        
        <textarea ondrop="dropHandler(event);"  class="h-[60vh] w-[100%] p-4" name="content" id="content">{{ $post->content }}</textarea>
        
        <button class="p-2 bg-green-500 rounded block mb-4">Save</button>
    </form>
    
    <input class="mb-4" type="file" id="upload_image" name="upload_image">

    <a href="{{ route('post.display', [$post->post_id]) }}">Cancel</a>
    
    

    <script src="{{ URL::asset('js/handle_file_upload.js'); }}"></script>
    <script src="{{ URL::asset('js/app.js'); }}"></script>
</div>



@endsection