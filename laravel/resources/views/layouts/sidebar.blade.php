<div class="sidebar welcome-header">
    @include('layouts.navigation')

    <img class="profile-pic" src="{{ URL::asset('images/profile/prof_pic1.jpg'); }}" alt="Profile picture of Tim">
    <div class="welcome-header-text">
        <p>
            Hey, my name's Tim, I'm a developer.
            I taught myself how to program in 2020, and have since been vastly expanding my skillsets.
            I made this blog to showcase some of the web development skills I've picked up.
        </p>
    </div>

    <div class="contact p=1 justify-self=flex-end">
        <p>Contact me:</p>
        <a class="mr=1 nav-link color=#0af" href="tel:716-229-1732">716-229-1732</a>
        <a class="nav-link color=#0af" href="https://twitter.com/JamminCoder">Twitter</a>
    </div>
</div>