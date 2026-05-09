@extends('layouts.app')

@section('title', 'Registrasi E-Voting')

@section('body')
<main class="login-page">
    <form class="login-card" method="POST" action="{{ route('register.store') }}">
        @csrf
        <h1>Registrasi</h1>
        <p class="lead">Buat akun pemilih E-Voting</p>

        @if ($errors->any())
            <div class="error-box" style="margin-top:24px">{{ $errors->first() }}</div>
        @endif

        <div class="input-wrap">
            <label for="npm">NPM</label>
            <input id="npm" name="npm" value="{{ old('npm') }}" placeholder="Masukkan NPM" autocomplete="username" required>
        </div>

        <div class="input-wrap">
            <label for="nama">Nama</label>
            <input id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" autocomplete="name" required>
        </div>

        <div class="input-wrap">
            <label for="jurusan">Jurusan</label>
            <input id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Masukkan jurusan" required>
        </div>

        <div class="input-wrap">
            <label for="prodi">Prodi</label>
            <input id="prodi" name="prodi" value="{{ old('prodi') }}" placeholder="Masukkan prodi" required>
        </div>

        <div class="input-wrap">
            <label for="pin">PIN</label>
            <input id="pin" name="pin" type="password" placeholder="Masukkan PIN" autocomplete="new-password" required>
            <button class="password-toggle" type="button" onclick="const input=document.getElementById('pin'); input.type=input.type === 'password' ? 'text' : 'password';"></button>
        </div>

        <button class="primary-btn" style="width:100%;height:46px;margin-top:24px" type="submit">Registrasi</button>
        <p class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </form>
</main>
@endsection
