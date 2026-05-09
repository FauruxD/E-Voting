@extends('layouts.admin')

@section('title', $candidate->exists ? 'Edit Kandidat' : 'Tambah Kandidat')
@section('admin_title', $candidate->exists ? 'Edit Kandidat' : 'Tambah Kandidat')

@section('content')
@php
    $programText = old('work_programs_text', collect($candidate->work_programs ?? [])->map(fn ($program) => ($program['title'] ?? '').' | '.($program['description'] ?? ''))->implode("\n"));
@endphp
<form class="content-card" style="padding:34px" method="POST" enctype="multipart/form-data" action="{{ $candidate->exists ? route('admin.candidates.update', $candidate) : route('admin.candidates.store') }}">
    @csrf
    @if ($candidate->exists)
        @method('PUT')
    @endif
    <div class="form-grid">
        <div class="field"><label>No Urut</label><input type="number" name="serial_number" value="{{ old('serial_number', $candidate->serial_number) }}" required></div>
        <div class="field"><label>Status</label><select name="status"><option value="verified" @selected(old('status', $candidate->status) === 'verified')>Verified</option><option value="pending" @selected(old('status', $candidate->status) === 'pending')>Pending Review</option></select></div>
        <div class="field"><label>Nama Ketua</label><input name="chairman_name" value="{{ old('chairman_name', $candidate->chairman_name) }}" required></div>
        <div class="field"><label>Nama Wakil</label><input name="vice_name" value="{{ old('vice_name', $candidate->vice_name) }}" required></div>
        <div class="field"><label>Fakultas</label><input name="faculty" value="{{ old('faculty', $candidate->faculty) }}"></div>
        <div class="field"><label>Jurusan</label><input name="major" value="{{ old('major', $candidate->major) }}"></div>
        <div class="field"><label>Angkatan</label><input name="batch" value="{{ old('batch', $candidate->batch) }}"></div>
        <div class="field"><label>Foto</label><input type="file" name="photo" accept="image/*"></div>
    </div>
    <div class="field"><label>Visi</label><textarea name="vision" required>{{ old('vision', $candidate->vision) }}</textarea></div>
    <div class="field"><label>Misi</label><textarea name="mission" required>{{ old('mission', $candidate->mission) }}</textarea></div>
    <div class="field"><label>Program Kerja</label><textarea name="work_programs_text" placeholder="Judul program | Deskripsi program">{{ $programText }}</textarea></div>
    <div class="form-actions">
        <a class="secondary-btn" href="{{ route('admin.candidates.index') }}">Batal</a>
        <button class="primary-btn small" type="submit">Simpan</button>
    </div>
</form>
@endsection
