<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- logo + name -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/rpg_icon.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
                Cacorrafiofobia
            </a>
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        <!-- Universal options -->
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">Home</a>
                        </li>
                        <!-- Admin option -->
                        @if (Auth::user()->isAdmin)
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                @auth
                    <form class="form-inline ms-auto d-flex" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                @else
                    <form class="form-inline ms-auto d-flex" action="">
                        @csrf
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-success">Login</a>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
</header>
