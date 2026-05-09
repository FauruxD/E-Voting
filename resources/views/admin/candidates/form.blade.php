@extends('layouts.admin')

@section('title', $candidate->exists ? 'Edit Kandidat' : 'Tambah Kandidat')
@section('admin_title', $candidate->exists ? 'Edit Kandidat' : 'Tambah Kandidat')

@section('content')
@php
    $programText = old('program_kerja_text', collect($candidate->program_kerja ?? [])->map(fn ($program) => ($program['title'] ?? '').' | '.($program['description'] ?? ''))->implode("\n"));
@endphp
<form class="content-card" style="padding:24px" method="POST" enctype="multipart/form-data" action="{{ $candidate->exists ? route('admin.candidates.update', $candidate) : route('admin.candidates.store') }}">
    @csrf
    @if ($candidate->exists)
        @method('PUT')
    @endif
    <div class="form-grid">
        <div class="field"><label>No Urut</label><input type="number" name="nomor_urut" value="{{ old('nomor_urut', $candidate->nomor_urut) }}" required></div>
        <div class="field"><label>Status</label><select name="status"><option value="verified" @selected(old('status', $candidate->status) === 'verified')>Verified</option><option value="pending" @selected(old('status', $candidate->status) === 'pending')>Pending Review</option></select></div>
        <div class="field"><label>Nama Ketua</label><input name="nama_ketua" value="{{ old('nama_ketua', $candidate->nama_ketua) }}" required></div>
        <div class="field"><label>Nama Wakil</label><input name="nama_wakil" value="{{ old('nama_wakil', $candidate->nama_wakil) }}" required></div>
        <div class="field"><label>Jurusan</label><input name="jurusan" value="{{ old('jurusan', $candidate->jurusan) }}"></div>
        <div class="field"><label>Prodi</label><input name="prodi" value="{{ old('prodi', $candidate->prodi) }}"></div>
        <div class="field"><label>Angkatan</label><input name="angkatan" value="{{ old('angkatan', $candidate->angkatan) }}"></div>
        <div class="field"><label>Foto</label><input type="file" name="foto" accept="image/*"></div>
    </div>
    <div class="field"><label>Visi</label><textarea name="visi" required>{{ old('visi', $candidate->visi) }}</textarea></div>
    <div class="field"><label>Misi</label><textarea name="misi" required>{{ old('misi', $candidate->misi) }}</textarea></div>
    <div class="field"><label>Program Kerja</label><textarea name="program_kerja_text" placeholder="Judul program | Deskripsi program">{{ $programText }}</textarea></div>
    <div class="form-actions">
        <a class="secondary-btn" href="{{ route('admin.candidates.index') }}">Batal</a>
        <button class="primary-btn small" type="submit">Simpan</button>
    </div>
</form>
@endsection
