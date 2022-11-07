<nav class="navbar">
    @if (Auth::check())
        <a class="nav-link" href="{{ route('post.create'); }}">Create Post</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a class="nav-link" href="{{ route('logout') }}" 
                onclick="event.preventDefault(); 
                this.closest('form').submit();">Logout</a>
        </form>
    @endif

    <a class="nav-link" href="{{ route('home'); }}">Home</a>
</nav>