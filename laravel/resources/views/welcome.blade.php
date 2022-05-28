@extends('layouts.home')

@section('title', 'Home')

@section('content')

<section>

    <div class='home-header-section'>
        <h1 class="home-header">Timothy Batt</h1>
        <div class='lead'>
            <h2>Software Developer</h2>
            <img class='profile-pic' src="{{ URL::asset('images/profile/prof_pic2.jpg') }}" alt="Image of Tim">
        </div>
    </div>
    
    <section class='home-paragraph'>
        <h2 class='home-paragraph__header'>What I do</h2>
        <p>
            My main focus is backend web development, but
            I have experience with frontend web dev, creating desktop apps,
            and writing automation scripts.
            My primary programming languages are Python, PHP, JavaScript, and Ruby;
            If needed, I can pick up a new language within a few days.
        </p>
    </section>

    <section class='home-paragraph'>
        <h2 class='home-paragraph__header'>Websites I've built</h2>
        <h3 class='mb-1'>1. This website</h3>
        <h3>2. <a href='http://geo.timbattblog.com'>Geography Quiz Website</a> - <a href='https://github.com/Jammin-Coder/geo.timbattblog.com'>(Source)</a></h3>
        <p>
            This is a simple website that quizzes you on the names of different countries.
        </p>
    </section>

    <section class='home-paragraph'>
        <h2 class='home-paragraph__header'>Cool Designs I've made</h2>
        <h3>1. <a href="https://codepen.io/JamminCoder/pen/WNMXgzg">Landing Page with Skewed Background</a></h3>
    </section>

    <section class='home-paragraph'>
        <h2 class='home-paragraph__header'>Notable apps I've made</h2>
        <h3 class="mb-1">Automatic Spreadsheet Upload Program</h3>
        <p class='mb-1'>
            This is a program I made for the FSGA (Florida State Golf Association).
            It uses Python with the Pandas and Selenium frameworks to parse data from spreadsheets,
            and then upload the parsed spreadsheet data to a form at
            <a href='https://courseratingpilot.usga.org/#!/home/coursedetails/'>courseratingpilot.usga.org</a>.
        </p>

        <h4>I will add more projects here as I make them</h4>
    </section>

    <h2 class="font-header mb=2em">Check out my blog posts!</h2>

    <!-- Load all the blog post previews here -->
    <div class="posts">
        @include('layouts.render-posts', ['posts' => $posts])
    </div>
</section>



@endsection