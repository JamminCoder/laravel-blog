@extends('layouts.home')

@section('title', 'Home')

@section('content')

<section>

    <div class='home-header-section'>
        <h1 class="home-header">Timothy Batt</h1>
        <p class="text-xl mb-8">Fullstack Developer</p>

        <div class="text-sm">
            <p>Contact Me:</p>
            <div class="flex gap-4">
                <a class="text-sky-400" href="tel:716-229-1732">716-229-1732</a>
                <a class="text-sky-400" href="https://twitter.com/JamminCoder">https://twitter.com/JamminCoder</a>
                <a class="text-sky-400" href="mailto:jammincoderguy96@gmail.com">jammincoderguy96@gmail.com</a>
            </div>
        </div>
    </div>
    
    <section class='py-4 mt-8 mb-12'>
        <h2 class='text-2xl font-semibold'>What I do</h2>
        <p class="mb-6">
            I'm a fullstack developer currently looking for opportunities to help
            businesses develop and/or improve their websites, as well as work on solutions to
            help them make their business more efficient with software.
        </p>

        <!-- Info seciton -->
        <div class="flex justify-around gap-4 border-y border-y-gray-700 py-4 px-2 font-thin">
            <a class="border-b" href="/skills">My Skills</a>
            <a class="border-b" href="/gallery">Work Gallery</a>
            <a class="border-b" href="/posts">Blog Posts</a>
        </div>
    </section>

    

    @if (count($posts) >= 1)
        <h2 class="text-3xl mb-8 font-semibold">Blog Posts.</h2>

        <!-- Load all the blog post previews here -->
        <div class="posts">
            @include('layouts.render-posts', ['posts' => $posts])
        </div>
    @endif
    
</section>



@endsection