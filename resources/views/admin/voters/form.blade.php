@extends('layouts.admin')

@section('title', $voter->exists ? 'Edit Pemilih' : 'Tambah Pemilih')
@section('admin_title', $voter->exists ? 'Edit Pemilih' : 'Tambah Pemilih')

@section('content')
<form class="content-card" style="padding:34px" method="POST" action="{{ $voter->exists ? route('admin.voters.update', $voter) : route('admin.voters.store') }}">
    @csrf
    @if ($voter->exists)
        @method('PUT')
    @endif
    <div class="form-grid">
        <div class="field"><label>NPM</label><input name="npm" value="{{ old('npm', $voter->npm) }}" required></div>
        <div class="field"><label>Nama Lengkap</label><input name="name" value="{{ old('name', $voter->name) }}" required></div>
        <div class="field"><label>Fakultas</label><input name="faculty" value="{{ old('faculty', $voter->faculty) }}"></div>
        <div class="field"><label>Jurusan</label><input name="major" value="{{ old('major', $voter->major) }}"></div>
        <div class="field"><label>PIN</label><input name="pin" value="{{ old('pin', $voter->pin) }}" required></div>
        <label class="remember" style="margin:32px 0 0"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $voter->is_active ?? true))> Akun aktif</label>
    </div>
    <div class="form-actions">
        <a class="secondary-btn" href="{{ route('admin.voters.index') }}">Batal</a>
        <button class="primary-btn small" type="submit">Simpan</button>
    </div>
</form>
@endsection
