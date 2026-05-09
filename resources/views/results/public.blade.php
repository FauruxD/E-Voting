@extends('layouts.voter')

@section('title', 'Rincian Perolehan')

@section('content')
<main class="container narrow">
    <div class="header-row">
        <div>
            <p class="eyebrow">{{ strtoupper($setting->election_title) }}</p>
            <h1>Rincian Perolehan</h1>
            <p class="lead">Hasil penghitungan suara secara real-time. Data diperbarui setiap 30 detik.</p>
        </div>
        <div style="display:flex;gap:22px;flex-wrap:wrap">
            <div class="stat-card"><div>Total Suara Masuk</div><strong>{{ number_format($summary['totalVotes'], 0, ',', '.') }}</strong></div>
            <div class="stat-card"><div>Partisipasi</div><strong style="color:var(--accent)">{{ $summary['participation'] }}%</strong></div>
        </div>
    </div>
    <div class="section-line"></div>

    @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
    @endif

    @if (! $setting->result_visibility)
        <div class="notice">Hasil belum tersedia. Admin belum mengaktifkan publikasi hasil voting.</div>
    @else
        <section class="result-list">
            @foreach ($results as $candidate)
                <article class="result-card {{ $loop->first ? 'top' : '' }}">
                    <div class="result-head">
                        <div class="result-name">
                            <div class="serial box">{{ str_pad($candidate->serial_number, 2, '0', STR_PAD_LEFT) }}</div>
                            <div>
                                <div style="color:var(--muted);letter-spacing:6px;text-transform:uppercase">Pasangan Calon</div>
                                <h2>{{ $candidate->pair_name }}</h2>
                                <div class="result-meta"><strong style="color:#fff">{{ $candidate->votes_count }}</strong> suara &nbsp; • &nbsp; {{ $candidate->major }}</div>
                            </div>
                        </div>
                        <div class="percent">{{ $candidate->percentage }}% <span>dari total suara</span></div>
                    </div>
                    <div class="progress"><span style="width:{{ $candidate->percentage }}%"></span></div>
                    <div style="display:flex;justify-content:space-between;color:#7c8492;margin-top:10px"><span>0%</span><span>100%</span></div>
                </article>
            @endforeach
        </section>

        <div class="stats-row" style="margin-top:70px">
            <div class="stat-card"><div>Total DPT</div><strong>{{ number_format($summary['totalVoters'], 0, ',', '.') }}</strong></div>
            <div class="stat-card"><div>Suara Sah</div><strong>{{ number_format($summary['totalVotes'], 0, ',', '.') }}</strong></div>
            <div class="stat-card"><div>Belum Memilih</div><strong>{{ number_format($summary['notVoted'], 0, ',', '.') }}</strong></div>
        </div>
    @endif
</main>
@endsection
