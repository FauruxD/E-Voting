<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\ResultService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function public(Request $request, ResultService $resultService): View
    {
        $setting = Setting::current();

        return view('results.public', [
            'setting' => $setting,
            'summary' => $resultService->summary(),
            'results' => $setting->result_visibility ? $resultService->candidateResults(true) : collect(),
            'user' => $request->user(),
        ]);
    }
}
