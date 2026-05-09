@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')
@section('admin_title', 'Pengaturan Sistem')
@section('admin_subtitle', 'Kelola konfigurasi dan status sistem e-voting')

@section('content')
<form class="content-card" style="padding:24px" method="POST" action="{{ route('admin.settings.update') }}">
    @csrf
    @method('PATCH')
    <h2 style="margin:0;font-size:20px">Konfigurasi Sistem</h2>
    <p style="color:var(--muted);margin-top:6px;font-size:14px">Atur status pemilihan dan visibilitas hasil kepada publik</p>
    <div class="section-line"></div>

    <div class="form-grid">
        <div class="field"><label>Nama Aplikasi</label><input name="nama_aplikasi" value="{{ old('nama_aplikasi', $setting->nama_aplikasi) }}" required></div>
        <div class="field"><label>Judul Pemilihan</label><input name="judul_pemilihan" value="{{ old('judul_pemilihan', $setting->judul_pemilihan) }}" required></div>
        <div class="field"><label>Mulai Voting</label><input type="datetime-local" name="mulai_voting" value="{{ old('mulai_voting', optional($setting->mulai_voting)->format('Y-m-d\\TH:i')) }}"></div>
        <div class="field"><label>Selesai Voting</label><input type="datetime-local" name="selesai_voting" value="{{ old('selesai_voting', optional($setting->selesai_voting)->format('Y-m-d\\TH:i')) }}"></div>
    </div>

    <div class="field" style="margin-top:20px">
        <label>Status Pemilihan</label>
        <p style="color:var(--muted);margin:0 0 22px">Tentukan apakah sesi voting saat ini aktif atau ditutup</p>
        <div class="choice-row">
            <label class="radio-card"><input type="radio" name="status_voting" value="open" @checked(old('status_voting', $setting->status_voting) === 'open')> Buka</label>
            <label class="radio-card"><input type="radio" name="status_voting" value="closed" @checked(old('status_voting', $setting->status_voting) === 'closed')> Tutup</label>
        </div>
    </div>

    <div class="section-line"></div>

    <div class="field">
        <label>Publikasi Hasil</label>
        <p style="color:var(--muted);margin:0 0 22px">Kontrol apakah hasil perolehan suara ditampilkan kepada publik</p>
        <div class="choice-row">
            <label class="radio-card"><input type="radio" name="hasil_ditampilkan" value="0" @checked(! old('hasil_ditampilkan', $setting->hasil_ditampilkan))> Sembunyikan</label>
            <label class="radio-card"><input type="radio" name="hasil_ditampilkan" value="1" @checked((bool) old('hasil_ditampilkan', $setting->hasil_ditampilkan))> Tampilkan ke Publik</label>
        </div>
    </div>

    <div class="form-actions" style="justify-content:center;margin-top:32px">
        <button class="primary-btn" type="submit">▣ Simpan Perubahan</button>
    </div>
</form>
@endsection
