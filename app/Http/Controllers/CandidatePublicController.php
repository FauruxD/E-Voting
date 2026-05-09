<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CandidatePublicController extends Controller
{
    public function show(Request $request, Candidate $candidate): View
    {
        abort_unless($candidate->status === 'verified', 404);

        return view('voter.candidate-show', [
            'candidate' => $candidate,
            'setting' => Setting::current(),
            'user' => $request->user(),
        ]);
    }
}
