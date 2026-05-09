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
                    <th>Fakultas / Jurusan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                    <tr>
                        <td><span style="color:var(--accent);font-weight:800;font-size:26px">{{ str_pad($candidate->serial_number, 2, '0', STR_PAD_LEFT) }}</span></td>
                        <td><div style="width:64px;height:48px;background:#151515;border-radius:6px"></div></td>
                        <td><strong>{{ $candidate->pair_name }}</strong><br><span style="color:var(--muted)">Visi: {{ str($candidate->vision)->limit(46) }}</span></td>
                        <td>{{ $candidate->faculty }} / {{ $candidate->major }}</td>
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
