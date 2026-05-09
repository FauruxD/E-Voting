<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VoterController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();

        $voters = User::where('peran', 'voter')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('nama', 'like', "%{$search}%")
                        ->orWhere('npm', 'like', "%{$search}%")
                        ->orWhere('prodi', 'like', "%{$search}%");
                });
            })
            ->orderBy('npm')
            ->paginate(10)
            ->withQueryString();

        return view('admin.voters.index', [
            'voters' => $voters,
            'search' => $search,
            'totalVoters' => User::where('peran', 'voter')->count(),
            'votedCount' => User::where('peran', 'voter')->where('sudah_memilih', true)->count(),
            'notVotedCount' => User::where('peran', 'voter')->where('sudah_memilih', false)->count(),
        ]);
    }

    public function create(): View
    {
        return view('admin.voters.form', [
            'voter' => new User(['aktif' => true]),
        ]);
    }

    public function store(Request $request, AuditLogService $auditLog): RedirectResponse
    {
        $data = $this->validated($request);
        $data['peran'] = 'voter';
        $data['sudah_memilih'] = false;
        $data['aktif'] = $request->boolean('aktif', true);

        $voter = User::create($data);
        $auditLog->record('voter_created', $request->user(), ['pemilih_id' => $voter->id], $request);

        return redirect()->route('admin.voters.index')->with('status', 'Pemilih berhasil ditambahkan.');
    }

    public function edit(User $voter): View
    {
        abort_unless($voter->peran === 'voter', 404);

        return view('admin.voters.form', compact('voter'));
    }

    public function update(Request $request, User $voter, AuditLogService $auditLog): RedirectResponse
    {
        abort_unless($voter->peran === 'voter', 404);

        $data = $this->validated($request, $voter);
        $data['aktif'] = $request->boolean('aktif');

        $voter->update($data);
        $auditLog->record('voter_updated', $request->user(), ['pemilih_id' => $voter->id], $request);

        return redirect()->route('admin.voters.index')->with('status', 'Pemilih berhasil diperbarui.');
    }

    public function destroy(Request $request, User $voter, AuditLogService $auditLog): RedirectResponse
    {
        abort_unless($voter->peran === 'voter', 404);

        $auditLog->record('voter_deleted', $request->user(), ['pemilih_id' => $voter->id], $request);
        $voter->delete();

        return redirect()->route('admin.voters.index')->with('status', 'Pemilih berhasil dihapus.');
    }

    private function validated(Request $request, ?User $voter = null): array
    {
        return $request->validate([
            'npm' => ['required', 'string', 'max:30', Rule::unique('users', 'npm')->ignore($voter?->id)],
            'nama' => ['required', 'string', 'max:255'],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'prodi' => ['nullable', 'string', 'max:255'],
            'pin' => ['required', 'string', 'max:255'],
            'aktif' => ['nullable'],
        ]);
    }
}
