@extends('layouts.app')

@section('body')
<div class="page-shell">
    <header class="topbar">
        <a class="brand" href="{{ route('voter.dashboard') }}">
            <img src="{{ asset('assets/pdf-extracted/page02_img01.jpeg') }}" alt="BEM E-Voting">
            <div>BEM E-VOTING</div>
        </a>
        <nav class="nav">
            <a class="{{ request()->routeIs('voter.dashboard', 'candidates.show') ? 'active' : '' }}" href="{{ route('voter.dashboard') }}">Beranda</a>
            <a class="{{ request()->routeIs('results.public') ? 'active' : '' }}" href="{{ route('results.public') }}">Hasil</a>
            <a href="#tentang">Tentang</a>
        </nav>
        <div class="account">
            <span>● {{ auth()->user()->name }}</span>
            <span class="divider"></span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="link-button" type="submit">↪ Logout</button>
            </form>
        </div>
    </header>

    @yield('content')

    <footer class="footer" id="tentang">
        <div class="footer-inner">
            <div>SUPPORT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; GUIDELINES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PRIVACY</div>
            <div>© 2026 BEM E-Voting. All rights reserved.</div>
        </div>
    </footer>
</div>
@endsection
