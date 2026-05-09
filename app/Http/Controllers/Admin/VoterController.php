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

        $voters = User::where('role', 'voter')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('npm', 'like', "%{$search}%")
                        ->orWhere('major', 'like', "%{$search}%");
                });
            })
            ->orderBy('npm')
            ->paginate(10)
            ->withQueryString();

        return view('admin.voters.index', [
            'voters' => $voters,
            'search' => $search,
            'totalVoters' => User::where('role', 'voter')->count(),
            'votedCount' => User::where('role', 'voter')->where('has_voted', true)->count(),
            'notVotedCount' => User::where('role', 'voter')->where('has_voted', false)->count(),
        ]);
    }

    public function create(): View
    {
        return view('admin.voters.form', [
            'voter' => new User(['is_active' => true]),
        ]);
    }

    public function store(Request $request, AuditLogService $auditLog): RedirectResponse
    {
        $data = $this->validated($request);
        $data['role'] = 'voter';
        $data['has_voted'] = false;
        $data['is_active'] = $request->boolean('is_active', true);

        $voter = User::create($data);
        $auditLog->record('voter_created', $request->user(), ['voter_id' => $voter->id], $request);

        return redirect()->route('admin.voters.index')->with('status', 'Pemilih berhasil ditambahkan.');
    }

    public function edit(User $voter): View
    {
        abort_unless($voter->role === 'voter', 404);

        return view('admin.voters.form', compact('voter'));
    }

    public function update(Request $request, User $voter, AuditLogService $auditLog): RedirectResponse
    {
        abort_unless($voter->role === 'voter', 404);

        $data = $this->validated($request, $voter);
        $data['is_active'] = $request->boolean('is_active');

        $voter->update($data);
        $auditLog->record('voter_updated', $request->user(), ['voter_id' => $voter->id], $request);

        return redirect()->route('admin.voters.index')->with('status', 'Pemilih berhasil diperbarui.');
    }

    public function destroy(Request $request, User $voter, AuditLogService $auditLog): RedirectResponse
    {
        abort_unless($voter->role === 'voter', 404);

        $auditLog->record('voter_deleted', $request->user(), ['voter_id' => $voter->id], $request);
        $voter->delete();

        return redirect()->route('admin.voters.index')->with('status', 'Pemilih berhasil dihapus.');
    }

    private function validated(Request $request, ?User $voter = null): array
    {
        return $request->validate([
            'npm' => ['required', 'string', 'max:30', Rule::unique('users', 'npm')->ignore($voter?->id)],
            'name' => ['required', 'string', 'max:255'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
            'pin' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable'],
        ]);
    }
}
