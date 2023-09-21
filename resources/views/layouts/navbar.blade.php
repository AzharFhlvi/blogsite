
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}">Blogsite</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('home') }}">Home</a>
                    </li>
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('home') }}">Home</a>
                    </li>
                    @role('user')
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('posts.dashboard') }}">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('posts.index') }}">My Post</a>
                    </li>
                    @endrole
                    @role('admin')
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('admin.index') }}">Admin</a>
                    </li>
                    @endrole
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>