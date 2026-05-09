<?php

namespace App\Services;

use App\Models\Candidate;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vote;
use Exception;
use Illuminate\Support\Facades\DB;

class VotingService
{
    public function submit(User $user, Candidate $candidate): void
    {
        $setting = Setting::current();

        if (! $user->isVoter()) {
            throw new Exception('Admin tidak dapat memberikan suara.');
        }

        if (! $user->aktif) {
            throw new Exception('Akun Anda tidak aktif.');
        }

        if ($candidate->status !== 'verified') {
            throw new Exception('Kandidat belum terverifikasi.');
        }

        if (! $setting->isVotingOpen()) {
            throw new Exception('Voting belum dibuka atau sudah ditutup.');
        }

        DB::transaction(function () use ($user, $candidate) {
            $lockedUser = User::whereKey($user->id)->lockForUpdate()->firstOrFail();

            if ($lockedUser->sudah_memilih || Vote::where('pemilih_id', $lockedUser->id)->exists()) {
                throw new Exception('Anda sudah melakukan voting.');
            }

            Vote::create([
                'pemilih_id' => $lockedUser->id,
                'kandidat_id' => $candidate->id,
                'dipilih_pada' => now(),
            ]);

            $lockedUser->update(['sudah_memilih' => true]);
        });
    }
}
