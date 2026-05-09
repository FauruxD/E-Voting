@extends('layouts.voter')

@section('title', 'Daftar Paslon')

@section('content')
<main class="container">
    <div class="header-row">
        <div>
            <p class="eyebrow">{{ strtoupper($setting->election_title) }}</p>
            <h1>Daftar Paslon</h1>
            <p class="lead">Pilih satu pasangan calon yang kamu dukung. Setiap pemilih hanya dapat memilih satu kali.</p>
        </div>
        <div class="timer">
            <div>Sisa Waktu Voting</div>
            <strong>{{ $setting->voting_end ? now()->diff($setting->voting_end)->format('%H : %I : %S') : '00 : 00 : 00' }}</strong>
        </div>
    </div>

    <div class="section-line"></div>

    @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="error-box">{{ $errors->first() }}</div>
    @endif

    <section class="candidate-grid">
        @foreach ($candidates as $candidate)
            <article class="candidate-card">
                <a class="candidate-cover" href="{{ route('candidates.show', $candidate) }}"></a>
                <div class="candidate-body">
                    <div class="candidate-title">
                        <div class="serial">{{ str_pad($candidate->serial_number, 2, '0', STR_PAD_LEFT) }}</div>
                        <div>
                            <div class="candidate-name">{{ $candidate->chairman_name }} <span>& {{ $candidate->vice_name }}</span></div>
                        </div>
                    </div>
                    <div class="pills">
                        <span class="pill">Ketua</span>
                        <span class="pill">Wakil Ketua</span>
                    </div>
                    <div class="mini-label">Visi</div>
                    <p>{{ $candidate->vision }}</p>
                    <form method="POST" action="{{ route('vote.store', $candidate) }}" style="margin-top:auto">
                        @csrf
                        <button class="primary-btn full" type="submit" @disabled(! $setting->isVotingOpen() || $user->has_voted)>▣ Pilih Paslon Ini</button>
                    </form>
                </div>
            </article>
        @endforeach
    </section>

    <div class="notice">
        Pastikan pilihan Anda sudah benar sebelum mengklik tombol <strong style="color:#fff">"Pilih Paslon Ini"</strong>.
        Suara yang telah diberikan <strong style="color:#fff">tidak dapat diubah</strong> dan bersifat final.
    </div>
</main>
@endsection
