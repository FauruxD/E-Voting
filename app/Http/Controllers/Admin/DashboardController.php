<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ResultService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(ResultService $resultService): View
    {
        return view('admin.dashboard.index', [
            'summary' => $resultService->summary(),
            'setting' => Setting::current(),
            'results' => $resultService->candidateResults(),
        ]);
    }
}
