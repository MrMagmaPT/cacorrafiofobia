<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Cacorrafiofobia - Login') }}</title>
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('../resources/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">
    <link rel="font" href="{{ asset('../resources/font/DragonSlayer.otf') }}">
</head>
<body class="bg-dark text-light">
<div class="d-flex flex-column justify-content-center align-items-center min-vh-100">
    <h1 class="dragon-text mb-4"><b>Login</b></h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="d-flex flex-column align-items-center">
            <!-- Email input -->
            <div class="form-outline mb-4 w-100" style="max-width: 350px;">
                <input name="email" type="email" id="emailInput" class="form-control bg-dark text-light"/>
                <label class="form-label" for="emailInput">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4 w-100" style="max-width: 350px;">
                <input name="password" type="password" id="passwordInput" class="form-control bg-dark text-light" />
                <label class="form-label" for="passwordInput">Password</label>
            </div>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

        @if($errors->has('login'))
            <div>{{ $errors->first('login') }}</div>
        @endif
    </form>
</div>
</body>
</html>
