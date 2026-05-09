@extends('layouts.admin')

@section('title', $voter->exists ? 'Edit Pemilih' : 'Tambah Pemilih')
@section('admin_title', $voter->exists ? 'Edit Pemilih' : 'Tambah Pemilih')

@section('content')
<form class="content-card" style="padding:24px" method="POST" action="{{ $voter->exists ? route('admin.voters.update', $voter) : route('admin.voters.store') }}">
    @csrf
    @if ($voter->exists)
        @method('PUT')
    @endif
    <div class="form-grid">
        <div class="field"><label>NPM</label><input name="npm" value="{{ old('npm', $voter->npm) }}" required></div>
        <div class="field"><label>Nama Lengkap</label><input name="nama" value="{{ old('nama', $voter->nama) }}" required></div>
        <div class="field"><label>Jurusan</label><input name="jurusan" value="{{ old('jurusan', $voter->jurusan) }}"></div>
        <div class="field"><label>Prodi</label><input name="prodi" value="{{ old('prodi', $voter->prodi) }}"></div>
        <div class="field"><label>PIN</label><input name="pin" value="{{ old('pin', $voter->pin) }}" required></div>
        <label class="remember" style="margin:32px 0 0"><input type="checkbox" name="aktif" value="1" @checked(old('aktif', $voter->aktif ?? true))> Akun aktif</label>
    </div>
    <div class="form-actions">
        <a class="secondary-btn" href="{{ route('admin.voters.index') }}">Batal</a>
        <button class="primary-btn small" type="submit">Simpan</button>
    </div>
</form>
@endsection
