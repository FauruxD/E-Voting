<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Setting;
use App\Services\AuditLogService;
use App\Services\VotingService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VotingController extends Controller
{
    public function index(Request $request): View
    {
        return view('voter.dashboard', [
            'setting' => Setting::current(),
            'candidates' => Candidate::where('status', 'verified')->orderBy('serial_number')->get(),
            'user' => $request->user(),
        ]);
    }

    public function store(
        Request $request,
        Candidate $candidate,
        VotingService $votingService,
        AuditLogService $auditLog
    ): RedirectResponse {
        try {
            $votingService->submit($request->user(), $candidate);
            $auditLog->record('vote_submitted', $request->user(), ['candidate_id' => $candidate->id], $request);

            return redirect()->route('results.public')->with('status', 'Suara Anda berhasil dikumpulkan.');
        } catch (Exception $exception) {
            return back()->withErrors(['vote' => $exception->getMessage()]);
        }
    }
}
