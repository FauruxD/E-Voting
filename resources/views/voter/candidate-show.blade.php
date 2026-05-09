@extends('layouts.voter')

@section('title', 'Detail Paslon')

@section('content')
@php
    $photo = $candidate->photo
        ? (str_starts_with($candidate->photo, 'assets/') ? asset($candidate->photo) : asset('storage/'.$candidate->photo))
        : asset('assets/pdf-extracted/page03_img05.jpeg');
@endphp
<main class="container narrow">
    <a class="back-link" href="{{ route('voter.dashboard') }}">← Kembali ke Daftar Paslon</a>

    @if ($errors->any())
        <div class="error-box">{{ $errors->first() }}</div>
    @endif

    <section class="detail-card hero-detail">
        <img src="{{ $photo }}" alt="{{ $candidate->pair_name }}">
        <div class="hero-copy">
            <div class="pills">
                <span class="pill" style="background:var(--accent);color:#091022;font-weight:800">{{ str_pad($candidate->serial_number, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="pill">{{ $candidate->major }}</span>
            </div>
            <h1>{{ $candidate->chairman_name }}</h1>
            <div class="amp">& {{ $candidate->vice_name }}</div>
            <div class="eyebrow" style="letter-spacing:3px;color:#aeb4bf">KETUA & WAKIL BEM</div>
            <div class="pills" style="margin-top:24px">
                <span class="pill">{{ $candidate->faculty }}</span>
                <span class="pill">Angkatan {{ $candidate->batch }}</span>
            </div>
        </div>
    </section>

    <section class="detail-card" style="margin-top:48px">
        <div class="text-block">
            <div class="block-title">Visi</div>
            <p>{{ $candidate->vision }}</p>
        </div>
        <div class="text-block">
            <div class="block-title">Misi</div>
            @foreach (preg_split('/\R+/', $candidate->mission) as $mission)
                @if (trim($mission) !== '')
                    <p style="margin-bottom:26px">{{ $mission }}</p>
                @endif
            @endforeach
        </div>
        <div class="text-block">
            <div class="block-title">Program Kerja Unggulan</div>
            @foreach (($candidate->work_programs ?? []) as $program)
                <div class="program">
                    <h3>{{ $program['title'] ?? '' }}</h3>
                    <p>{{ $program['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
        <div class="text-block">
            <div class="warning-box">
                <div class="serial box" style="width:58px;height:58px;min-width:58px;font-size:24px;background:#3b2a0a;color:var(--warning)">!</div>
                <div>
                    <h3 style="margin:0 0 8px;font-size:24px">Perhatian</h3>
                    <p>Apakah Anda yakin ingin memberikan suara untuk Paslon ini? <strong>Pilihan yang sudah dikonfirmasi tidak dapat diubah.</strong> Pastikan Anda telah membaca seluruh visi, misi, dan program kerja sebelum melanjutkan.</p>
                </div>
            </div>
            <form method="POST" action="{{ route('vote.store', $candidate) }}" style="margin-top:36px">
                @csrf
                <button class="primary-btn" style="width:100%;height:78px" type="submit" @disabled(! $setting->isVotingOpen() || $user->has_voted)>Konfirmasi & Kumpulkan Suara</button>
            </form>
            <p style="text-align:center;color:var(--muted);font-size:18px;margin-top:26px">Dengan menekan tombol di atas, Anda menyatakan telah membaca dan memahami semua informasi paslon ini.</p>
        </div>
    </section>
</main>
@endsection
