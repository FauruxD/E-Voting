<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidatePublicController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\VotingController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'peran:voter'])->group(function () {
    Route::get('/dashboard', [VotingController::class, 'index'])->name('voter.dashboard');
    Route::get('/candidates/{candidate}', [CandidatePublicController::class, 'show'])->name('candidates.show');
    Route::post('/vote/{candidate}', [VotingController::class, 'store'])->name('vote.store');
    Route::get('/results', [ResultController::class, 'public'])->name('results.public');
});

Route::middleware(['auth', 'peran:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/voters', Admin\VoterController::class)->except(['show'])->parameters(['voters' => 'voter']);
        Route::resource('/candidates', Admin\CandidateController::class)->except(['show']);
        Route::get('/results', [Admin\ResultController::class, 'index'])->name('results.index');
        Route::get('/settings', [Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::patch('/settings', [Admin\SettingController::class, 'update'])->name('settings.update');
    });
