@extends('layouts.admin')

@section('title', 'Hasil Perolehan Suara')
@section('admin_title', 'Hasil Perolehan Suara')

@section('content')
<section class="stats-row">
    <div class="stat-card"><div class="label">Total Suara Masuk</div><strong>{{ number_format($summary['totalVotes'], 0, ',', '.') }}</strong></div>
    <div class="stat-card"><div class="label">Total Pemilih Terdaftar</div><strong>{{ number_format($summary['totalVoters'], 0, ',', '.') }}</strong></div>
    <div class="stat-card"><div class="label">Tingkat Partisipasi</div><strong>{{ $summary['participation'] }}%</strong></div>
</section>

<section class="result-list">
    @foreach ($results as $candidate)
        <article class="result-card {{ $loop->first ? 'top' : '' }}">
            <div class="result-head">
                <div class="result-name">
                    <div class="serial box">{{ str_pad($candidate->serial_number, 2, '0', STR_PAD_LEFT) }}</div>
                    <div>
                        <h2>Paslon {{ str_pad($candidate->serial_number, 2, '0', STR_PAD_LEFT) }}: {{ $candidate->pair_name }}</h2>
                        <div class="result-meta">Visi: {{ str($candidate->vision)->limit(60) }}</div>
                    </div>
                </div>
                <div class="percent" style="font-size:34px">{{ number_format($candidate->votes_count, 0, ',', '.') }}<span>Suara</span><strong style="font-size:31px;color:#fff">{{ $candidate->percentage }}%</strong></div>
            </div>
            <div class="progress"><span style="width:{{ $candidate->percentage }}%"></span></div>
            <div style="display:flex;justify-content:space-between;color:#8e8e8e;margin-top:10px"><span>0%</span><span>{{ $candidate->percentage }}% dari total suara</span><span>100%</span></div>
        </article>
    @endforeach
</section>
<p style="color:var(--muted);margin-top:38px">◷ Terakhir diperbarui: <strong style="color:#fff">{{ now()->format('d M Y, H:i') }} WIB</strong></p>
@endsection
