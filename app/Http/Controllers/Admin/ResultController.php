<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ResultService;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function index(ResultService $resultService): View
    {
        return view('admin.results.index', [
            'summary' => $resultService->summary(),
            'results' => $resultService->candidateResults(),
        ]);
    }
}
