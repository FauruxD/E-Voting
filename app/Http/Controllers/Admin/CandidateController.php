<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CandidateController extends Controller
{
    public function index(): View
    {
        return view('admin.candidates.index', [
            'candidates' => Candidate::withCount('votes')->orderBy('nomor_urut')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.candidates.form', [
            'candidate' => new Candidate(['status' => 'pending']),
        ]);
    }

    public function store(Request $request, AuditLogService $auditLog): RedirectResponse
    {
        $data = $this->validated($request);
        $data['program_kerja'] = $this->parsePrograms($request->string('program_kerja_text')->toString());
        $data['foto'] = $this->storeFoto($request);
        unset($data['program_kerja_text']);

        $candidate = Candidate::create($data);
        $auditLog->record('candidate_created', $request->user(), ['kandidat_id' => $candidate->id], $request);

        return redirect()->route('admin.candidates.index')->with('status', 'Kandidat berhasil ditambahkan.');
    }

    public function edit(Candidate $candidate): View
    {
        return view('admin.candidates.form', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate, AuditLogService $auditLog): RedirectResponse
    {
        $data = $this->validated($request, $candidate);
        $data['program_kerja'] = $this->parsePrograms($request->string('program_kerja_text')->toString());
        unset($data['program_kerja_text']);

        if ($request->hasFile('foto')) {
            if ($candidate->foto) {
                Storage::disk('public')->delete($candidate->foto);
            }

            $data['foto'] = $this->storeFoto($request);
        }

        $candidate->update($data);
        $auditLog->record('candidate_updated', $request->user(), ['kandidat_id' => $candidate->id], $request);

        return redirect()->route('admin.candidates.index')->with('status', 'Kandidat berhasil diperbarui.');
    }

    public function destroy(Request $request, Candidate $candidate, AuditLogService $auditLog): RedirectResponse
    {
        $auditLog->record('candidate_deleted', $request->user(), ['kandidat_id' => $candidate->id], $request);
        $candidate->delete();

        return redirect()->route('admin.candidates.index')->with('status', 'Kandidat berhasil dihapus.');
    }

    private function validated(Request $request, ?Candidate $candidate = null): array
    {
        return $request->validate([
            'nomor_urut' => ['required', 'integer', 'min:1', Rule::unique('candidates', 'nomor_urut')->ignore($candidate?->id)],
            'nama_ketua' => ['required', 'string', 'max:255'],
            'nama_wakil' => ['required', 'string', 'max:255'],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'prodi' => ['nullable', 'string', 'max:255'],
            'angkatan' => ['nullable', 'string', 'max:50'],
            'visi' => ['required', 'string'],
            'misi' => ['required', 'string'],
            'program_kerja_text' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:4096'],
            'status' => ['required', Rule::in(['verified', 'pending'])],
        ]);
    }

    private function parsePrograms(string $text): array
    {
        return collect(preg_split('/\R+/', trim($text)))
            ->filter()
            ->map(function (string $line) {
                [$title, $description] = array_pad(explode('|', $line, 2), 2, '');

                return [
                    'title' => trim($title),
                    'description' => trim($description),
                ];
            })
            ->values()
            ->all();
    }

    private function storeFoto(Request $request): ?string
    {
        if (! $request->hasFile('foto')) {
            return null;
        }

        return $request->file('foto')->store('candidates', 'public');
    }
}
