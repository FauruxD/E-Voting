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
            'candidates' => Candidate::withCount('votes')->orderBy('serial_number')->get(),
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
        $data['work_programs'] = $this->parsePrograms($request->string('work_programs_text')->toString());
        $data['photo'] = $this->storePhoto($request);
        unset($data['work_programs_text']);

        $candidate = Candidate::create($data);
        $auditLog->record('candidate_created', $request->user(), ['candidate_id' => $candidate->id], $request);

        return redirect()->route('admin.candidates.index')->with('status', 'Kandidat berhasil ditambahkan.');
    }

    public function edit(Candidate $candidate): View
    {
        return view('admin.candidates.form', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate, AuditLogService $auditLog): RedirectResponse
    {
        $data = $this->validated($request, $candidate);
        $data['work_programs'] = $this->parsePrograms($request->string('work_programs_text')->toString());
        unset($data['work_programs_text']);

        if ($request->hasFile('photo')) {
            if ($candidate->photo && ! str_starts_with($candidate->photo, 'assets/')) {
                Storage::disk('public')->delete($candidate->photo);
            }

            $data['photo'] = $this->storePhoto($request);
        }

        $candidate->update($data);
        $auditLog->record('candidate_updated', $request->user(), ['candidate_id' => $candidate->id], $request);

        return redirect()->route('admin.candidates.index')->with('status', 'Kandidat berhasil diperbarui.');
    }

    public function destroy(Request $request, Candidate $candidate, AuditLogService $auditLog): RedirectResponse
    {
        $auditLog->record('candidate_deleted', $request->user(), ['candidate_id' => $candidate->id], $request);
        $candidate->delete();

        return redirect()->route('admin.candidates.index')->with('status', 'Kandidat berhasil dihapus.');
    }

    private function validated(Request $request, ?Candidate $candidate = null): array
    {
        return $request->validate([
            'serial_number' => ['required', 'integer', 'min:1', Rule::unique('candidates', 'serial_number')->ignore($candidate?->id)],
            'chairman_name' => ['required', 'string', 'max:255'],
            'vice_name' => ['required', 'string', 'max:255'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
            'batch' => ['nullable', 'string', 'max:50'],
            'vision' => ['required', 'string'],
            'mission' => ['required', 'string'],
            'work_programs_text' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:4096'],
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

    private function storePhoto(Request $request): ?string
    {
        if (! $request->hasFile('photo')) {
            return null;
        }

        return $request->file('photo')->store('candidates', 'public');
    }
}
