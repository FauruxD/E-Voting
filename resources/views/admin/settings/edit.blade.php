@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')
@section('admin_title', 'Pengaturan Sistem')
@section('admin_subtitle', 'Kelola konfigurasi dan status sistem e-voting')

@section('content')
<form class="content-card" style="padding:44px" method="POST" action="{{ route('admin.settings.update') }}">
    @csrf
    @method('PATCH')
    <h2 style="margin:0;font-size:26px">Konfigurasi Sistem</h2>
    <p style="color:var(--muted);margin-top:8px">Atur status pemilihan dan visibilitas hasil kepada publik</p>
    <div class="section-line"></div>

    <div class="form-grid">
        <div class="field"><label>Nama Aplikasi</label><input name="app_name" value="{{ old('app_name', $setting->app_name) }}" required></div>
        <div class="field"><label>Judul Pemilihan</label><input name="election_title" value="{{ old('election_title', $setting->election_title) }}" required></div>
        <div class="field"><label>Mulai Voting</label><input type="datetime-local" name="voting_start" value="{{ old('voting_start', optional($setting->voting_start)->format('Y-m-d\\TH:i')) }}"></div>
        <div class="field"><label>Selesai Voting</label><input type="datetime-local" name="voting_end" value="{{ old('voting_end', optional($setting->voting_end)->format('Y-m-d\\TH:i')) }}"></div>
    </div>

    <div class="field" style="margin-top:28px">
        <label>Status Pemilihan</label>
        <p style="color:var(--muted);margin:0 0 22px">Tentukan apakah sesi voting saat ini aktif atau ditutup</p>
        <div class="choice-row">
            <label class="radio-card"><input type="radio" name="voting_status" value="open" @checked(old('voting_status', $setting->voting_status) === 'open')> Buka</label>
            <label class="radio-card"><input type="radio" name="voting_status" value="closed" @checked(old('voting_status', $setting->voting_status) === 'closed')> Tutup</label>
        </div>
    </div>

    <div class="section-line"></div>

    <div class="field">
        <label>Publikasi Hasil</label>
        <p style="color:var(--muted);margin:0 0 22px">Kontrol apakah hasil perolehan suara ditampilkan kepada publik</p>
        <div class="choice-row">
            <label class="radio-card"><input type="radio" name="result_visibility" value="0" @checked(! old('result_visibility', $setting->result_visibility))> Sembunyikan</label>
            <label class="radio-card"><input type="radio" name="result_visibility" value="1" @checked((bool) old('result_visibility', $setting->result_visibility))> Tampilkan ke Publik</label>
        </div>
    </div>

    <div class="form-actions" style="justify-content:center;margin-top:72px">
        <button class="primary-btn" type="submit">▣ Simpan Perubahan</button>
    </div>
</form>
@endsection
