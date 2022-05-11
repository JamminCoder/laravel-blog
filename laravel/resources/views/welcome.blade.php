@extends('layouts.home')

@section('title', 'Home')

@section('content')

<section>

    <div class='home-header-section'>
        <h1 class="home-header">Timothy Batt</h1>
        <div class='lead flex justify-between align-center'>
            <h2>Software Developer</h2>
            <img class='profile-pic' src="{{ URL::asset('images/profile/prof_pic2.jpg') }}" alt="Image of Tim">
        </div>
    </div>
    
    <section class='home-paragraph'>
        <h3>What I do</h3>
        <p>
            My main focus is backend web development, but
            I have experience with frontend web dev, creating desktop apps,
            and writing automation scripts.
            My primary programming languages are Python, PHP, JavaScript, and Ruby;
            If needed, I can pick up a new language within a week.
        </p>
    </section>

    <h2 class="font-header mb=2em">Check out my blog posts!</h2>

    <!-- Load all the blog post previews here -->
    <div class="posts">
        @include('layouts.render-posts', ['posts' => $posts])
    </div>
</section>



@endsection