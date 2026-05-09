@extends('layouts.voter')

@section('title', 'Detail Paslon')

@section('content')
@php
    $foto = $candidate->foto
        ? (str_starts_with($candidate->foto, 'assets/') ? asset($candidate->foto) : asset('storage/'.$candidate->foto))
        : asset('assets/pdf-extracted/page03_img05.jpeg');
@endphp
<main class="container narrow">
    <a class="back-link" href="{{ route('voter.dashboard') }}">← Kembali ke Daftar Paslon</a>

    @if ($errors->any())
        <div class="error-box">{{ $errors->first() }}</div>
    @endif

    <section class="detail-card hero-detail">
        <img src="{{ $foto }}" alt="{{ $candidate->pair_name }}">
        <div class="hero-copy">
            <div class="pills">
                <span class="pill" style="background:var(--accent);color:#091022;font-weight:800">{{ str_pad($candidate->nomor_urut, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="pill">{{ $candidate->prodi }}</span>
            </div>
            <h1>{{ $candidate->nama_ketua }}</h1>
            <div class="amp">& {{ $candidate->nama_wakil }}</div>
            <div class="eyebrow" style="letter-spacing:3px;color:#aeb4bf">KETUA & WAKIL BEM</div>
            <div class="pills" style="margin-top:24px">
                <span class="pill">{{ $candidate->jurusan }}</span>
                <span class="pill">Angkatan {{ $candidate->angkatan }}</span>
            </div>
        </div>
    </section>

    <section class="detail-card" style="margin-top:28px">
        <div class="text-block">
            <div class="block-title">Visi</div>
            <p>{{ $candidate->visi }}</p>
        </div>
        <div class="text-block">
            <div class="block-title">Misi</div>
            @foreach (preg_split('/\R+/', $candidate->misi) as $misi)
                @if (trim($misi) !== '')
                    <p style="margin-bottom:26px">{{ $misi }}</p>
                @endif
            @endforeach
        </div>
        <div class="text-block">
            <div class="block-title">Program Kerja Unggulan</div>
            @foreach (($candidate->program_kerja ?? []) as $program)
                <div class="program">
                    <h3>{{ $program['title'] ?? '' }}</h3>
                    <p>{{ $program['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
        <div class="text-block">
            <div class="warning-box">
                <div class="serial box" style="width:44px;height:44px;min-width:44px;font-size:18px;background:#3b2a0a;color:var(--warning)">!</div>
                <div>
                    <h3 style="margin:0 0 6px;font-size:17px">Perhatian</h3>
                    <p>Apakah Anda yakin ingin memberikan suara untuk Paslon ini? <strong>Pilihan yang sudah dikonfirmasi tidak dapat diubah.</strong> Pastikan Anda telah membaca seluruh visi, misi, dan program kerja sebelum melanjutkan.</p>
                </div>
            </div>
            <form method="POST" action="{{ route('vote.store', $candidate) }}" style="margin-top:24px">
                @csrf
                <button class="primary-btn" style="width:100%;height:46px" type="submit" @disabled(! $setting->isVotingOpen() || $user->sudah_memilih)>Konfirmasi & Kumpulkan Suara</button>
            </form>
            <p style="text-align:center;color:var(--muted);font-size:13px;margin-top:16px">Dengan menekan tombol di atas, Anda menyatakan telah membaca dan memahami semua informasi paslon ini.</p>
        </div>
    </section>
</main>
@endsection
