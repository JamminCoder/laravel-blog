@extends('layouts.app')

@section("title", "New Post")

@section("content")

<div class="grid place-content-center px-1 mt-4">

    <form class="max-w-[30rem] w-[100%]" id="markdown_form" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $post->post_id }}" name="post_id"/>
        <div class="flex flex-col gap-4 mb-12">  
            <input type="text" name="post_title" id="post_title" class="bg-[#1e1e1e] font-bold text-2xl border-x-0 border-t-0 border-b-slate-700" placeholder="Title">
            
            <br>

            <input type="text" name="post_description" id="post_description" class="bg-[#1e1e1e] font-bold text-2xl border-x-0 border-t-0 border-b-slate-700" placeholder="Describe your post breifly">
        </div>

        <textarea class="h-[60vh] w-[100%]" name="post_content" id="post_content"></textarea>

        <button class="p-2 bg-green-500 rounded block">Submit</button>
    </form>

    <script src="{{ URL::asset('js/handle_file_upload.js'); }}"></script>
</div>

@endsection