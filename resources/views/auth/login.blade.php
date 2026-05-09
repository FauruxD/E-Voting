@extends('layouts.app')

@section('title', 'Login E-Voting')

@section('body')
<main class="login-page">
    <form class="login-card" method="POST" action="{{ route('login.store') }}">
        @csrf
        <h1>Login E-Voting</h1>
        <p class="lead">Masukkan NPM dan PIN Anda</p>

        @if ($errors->any())
            <div class="error-box" style="margin-top:24px">{{ $errors->first() }}</div>
        @endif

        <div class="input-wrap">
            <label for="npm">NPM</label>
            <span class="input-icon">▣</span>
            <input id="npm" name="npm" value="{{ old('npm') }}" placeholder="Enter your 10-digit NPM" autocomplete="username" required>
        </div>

        <div class="input-wrap">
            <label for="pin">PIN</label>
            <span class="input-icon">▥</span>
            <input id="pin" name="pin" type="password" placeholder="Enter your 6-digit PIN" autocomplete="current-password" required>
            <button class="password-toggle" type="button" onclick="const input=document.getElementById('pin'); input.type=input.type === 'password' ? 'text' : 'password';">◉</button>
        </div>

        <label class="remember">
            <input type="checkbox" name="remember" value="1">
            Remember me
        </label>

        <button class="primary-btn" style="width:100%;height:46px" type="submit">Masuk</button>
    </form>
</main>
@endsection
