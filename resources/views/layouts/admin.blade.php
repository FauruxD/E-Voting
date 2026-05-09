@extends('layouts.app')

@section('body')
<div class="admin-shell">
    <aside class="sidebar">
        <a class="brand" href="{{ route('admin.dashboard') }}">BEM <span>E-VOTING</span></a>
        <div class="admin-profile">
            <div class="avatar"></div>
            <div>{{ auth()->user()->name }}</div>
        </div>
        <nav class="side-nav">
            <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">▰ Dashboard</a>
            <a class="{{ request()->routeIs('admin.candidates.*') ? 'active' : '' }}" href="{{ route('admin.candidates.index') }}">● Kandidat</a>
            <a class="{{ request()->routeIs('admin.voters.*') ? 'active' : '' }}" href="{{ route('admin.voters.index') }}">▥ Pemilih</a>
            <a class="{{ request()->routeIs('admin.results.*') ? 'active' : '' }}" href="{{ route('admin.results.index') }}">▣ Hasil</a>
            <a class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">⚙ Pengaturan</a>
        </nav>
        <form class="side-logout" method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="link-button" type="submit">Logout</button>
        </form>
    </aside>
    <main class="admin-main">
        <header class="admin-header">
            <div>
                <h1>@yield('admin_title')</h1>
                @hasSection('admin_subtitle')
                    <p class="lead" style="font-size:21px;margin-top:6px">@yield('admin_subtitle')</p>
                @endif
            </div>
            @yield('admin_action')
        </header>
        <div class="admin-content">
            @if (session('status'))
                <div class="flash">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="error-box">{{ $errors->first() }}</div>
            @endif
            @yield('content')
        </div>
        <footer class="footer"><div class="footer-inner" style="justify-content:center">BEM E-Voting</div></footer>
    </main>
</div>
@endsection
