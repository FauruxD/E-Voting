@extends('layouts.admin')

@section('title', 'Manajemen Kandidat')
@section('admin_title', 'Manajemen Kandidat')
@section('admin_subtitle', 'Kelola data pasangan calon BEM')
@section('admin_action')
    <a class="primary-btn" href="{{ route('admin.candidates.create') }}">+ Tambah Kandidat</a>
@endsection

@section('content')
<section class="table-card">
    <div style="overflow:auto">
        <table>
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Foto</th>
                    <th>Nama Paslon</th>
                    <th>Jurusan / Prodi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                    @php
                        $fotoUrl = $candidate->foto && ! str_starts_with($candidate->foto, 'assets/')
                            ? asset('storage/'.$candidate->foto)
                            : asset('images/default-candidate.svg');
                    @endphp
                    <tr>
                        <td><span style="color:var(--accent);font-weight:800;font-size:18px">{{ str_pad($candidate->nomor_urut, 2, '0', STR_PAD_LEFT) }}</span></td>
                        <td><img src="{{ $fotoUrl }}" alt="{{ $candidate->nama_ketua }} & {{ $candidate->nama_wakil }}" style="width:48px;height:36px;object-fit:cover;background:#151515;border-radius:6px"></td>
                        <td><strong>{{ $candidate->pair_name }}</strong><br><span style="color:var(--muted)">Visi: {{ str($candidate->visi)->limit(46) }}</span></td>
                        <td>{{ $candidate->jurusan }} / {{ $candidate->prodi }}</td>
                        <td>
                            @if ($candidate->status === 'verified')
                                <span class="status success">Verified</span>
                            @else
                                <span class="status warning">Pending Review</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a class="action-edit" href="{{ route('admin.candidates.edit', $candidate) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.candidates.destroy', $candidate) }}" onsubmit="return confirm('Hapus kandidat ini?')">
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
</section>
@endsection
