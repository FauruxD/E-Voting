@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('admin_title', 'Admin Dashboard')

@section('content')
<p class="eyebrow" style="color:#7f8492">Ringkasan Pemilihan</p>

<section class="stats-row">
    <div class="stat-card"><div class="label">Total DPT</div><strong>{{ number_format($summary['totalVoters'], 0, ',', '.') }}</strong><div style="color:var(--dim);margin-top:8px;font-size:13px">Daftar Pemilih Tetap</div></div>
    <div class="stat-card"><div class="label">Suara Masuk</div><strong>{{ number_format($summary['totalVotes'], 0, ',', '.') }}</strong><div style="color:var(--dim);margin-top:8px;font-size:13px">Suara sah diterima</div></div>
    <div class="stat-card"><div class="label">Belum Memilih</div><strong>{{ number_format($summary['notVoted'], 0, ',', '.') }}</strong><div style="color:var(--dim);margin-top:8px;font-size:13px">Pemilih belum bersuara</div></div>
</section>

<section class="content-card" style="padding:24px;margin-top:36px">
    <div style="display:flex;justify-content:space-between;gap:20px">
        <div class="label" style="color:#9ca3af;text-transform:uppercase;letter-spacing:5px;font-weight:800">Tingkat Partisipasi Keseluruhan</div>
        <strong style="color:var(--accent);font-size:20px">{{ $summary['participation'] }}%</strong>
    </div>
    <div class="progress"><span style="width:{{ $summary['participation'] }}%"></span></div>
    <div style="display:flex;justify-content:space-between;color:#7c8492;margin-top:8px;font-size:13px"><span>0%</span><span>100%</span></div>
</section>
@endsection
