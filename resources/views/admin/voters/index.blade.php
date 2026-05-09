@extends('layouts.admin')

@section('title', 'Daftar Pemilih')
@section('admin_title', 'Daftar Pemilih')

@section('content')
<section class="stats-row">
    <div class="stat-card"><div class="label">Total Pemilih</div><strong>{{ number_format($totalVoters, 0, ',', '.') }}</strong></div>
    <div class="stat-card"><div class="label">Sudah Memilih</div><strong>{{ number_format($votedCount, 0, ',', '.') }}</strong></div>
    <div class="stat-card"><div class="label">Belum Memilih</div><strong>{{ number_format($notVotedCount, 0, ',', '.') }}</strong></div>
</section>

<section class="table-card">
    <div class="table-toolbar">
        <div>
            <h2>Data Pemilih</h2>
            <p>Manajemen daftar pemilih tetap</p>
        </div>
        <form method="GET" style="display:flex;gap:18px;align-items:center;flex-wrap:wrap">
            <input class="search" name="search" value="{{ $search }}" placeholder="Cari Pemilih...">
            <button class="primary-btn small" type="submit">Cari</button>
            <a class="primary-btn small" href="{{ route('admin.voters.create') }}">+ Tambah Data</a>
        </form>
    </div>
    <div style="overflow:auto">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama Lengkap</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($voters as $voter)
                    <tr>
                        <td>{{ $loop->iteration + (($voters->currentPage() - 1) * $voters->perPage()) }}</td>
                        <td>{{ $voter->npm }}</td>
                        <td><strong>{{ $voter->name }}</strong></td>
                        <td>
                            @if ($voter->has_voted)
                                <span class="status success">● Sudah</span>
                            @else
                                <span class="status danger">○ Belum</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a class="action-edit" href="{{ route('admin.voters.edit', $voter) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.voters.destroy', $voter) }}" onsubmit="return confirm('Hapus pemilih ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-delete" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding:24px 38px;color:var(--muted)">{{ $voters->links() }}</div>
</section>
@endsection
