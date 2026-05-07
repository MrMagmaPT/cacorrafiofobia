@extends('layouts.app')

@auth
    @section('title', 'Home - ' . Auth::user()->name)
@else
    @section('title', 'Welcome to Cacorrafiofobia')
@endauth

@section('title', 'Welcome to Ca')

@section('content')
    @auth
        <!-- Main content for authenticated users -->
        <div class="container-fluid text-center">
            <br><br><br>
            <h1 class="title"><b class="dragon-text">Cacorrafiofobia</b></h1>
            <h1>Welcome back <b class="dragon-text">{{ Auth::user()->name ?? '' }}</b> to the web Hub</h1>
            <br>
            <h5>Add a character to start or check your characters</h5>
            <a class="btn btn-sm btn-outline-dark" href="{{ route('characters.create') }}">Create Character</a>
            <a class="btn btn-sm btn-outline-dark" href="{{ route('characters.index') }}">Check Character</a>
        </div>
    @else
        <!-- Main content for unauthenticated users -->
        <div class="container-fluid text-center">
            <br><br><br>
            <h1 class="title"><b class="dragon-text">Cacorrafiofobia</b></h1>
            <h1>Welcome to the web Hub</h1>
            <br>
            <h5>To start uploading characters and building your story please <a href="{{ route('login') }}">login</a></h5>
            <h5>using the credentials given to you by the DM</h5>
        </div>
    @endauth
@endsection
