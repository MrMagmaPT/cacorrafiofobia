<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Cacorrafiofobia') }}</title>
        <link rel="icon" href="./favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="font" href="{{ asset('font/DragonSlayer.otf') }}">
    </head>
    <body class="bg-light-subtle text-dark d-flex flex-column min-vh-100">
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
                                <li class="nav-item">
                                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                                </li>
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
                            <form class="form-inline ms-auto d-flex" method="GET" action="{{ route('login') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success">login</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>
        <main class="flex-fill">
            @auth
            @else
                <!-- Main content for unauthenticated users -->
                <div class="container-fluid text-center">
                    <br><br><br><br><br>
                    <h1 class="title"><b class="dragon-text">Cacorrafiofobia</b></h1>
                    <h1>Welcome to the web Hub</h1>
                    <br>
                    <h5>To start uploading characters and building your story please <a href="">login</a></h5>
                    <h5>using the credentials given to you by the DM</h5>
                </div>
            @endauth
        </main>
        <footer class="bg-body-tertiary text-center text-lg-start mt-auto">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © <?php echo date("Y") ?> Copyright:
                <a class="text-body" target="_blank" href="http://2.80.90.117/">Cacorrafiofobia</a>
            </div>
            <!-- Copyright -->
        </footer>
    </body>
</html>
