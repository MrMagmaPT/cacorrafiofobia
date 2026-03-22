<form method="POST" action="{{ route('login') }}">
@csrf
<label>Email:</label>
<input type="email" name="email" required>
<br>
<label>Password:</label>
<input type="password" name="password" required>
<br>
<button type="submit">Login</button>
@if($errors->has('login'))
    <div>{{ $errors->first('login') }}</div>
    @endif
    </form>
