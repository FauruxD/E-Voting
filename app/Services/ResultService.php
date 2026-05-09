<?php

namespace App\Services;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Collection;

class ResultService
{
    public function summary(): array
    {
        $totalVoters = User::where('role', 'voter')->count();
        $totalVotes = Vote::count();
        $notVoted = max($totalVoters - $totalVotes, 0);
        $participation = $totalVoters > 0 ? round(($totalVotes / $totalVoters) * 100, 1) : 0;

        return compact('totalVoters', 'totalVotes', 'notVoted', 'participation');
    }

    public function candidateResults(bool $verifiedOnly = false): Collection
    {
        $totalVotes = Vote::count();

        return Candidate::query()
            ->when($verifiedOnly, fn ($query) => $query->where('status', 'verified'))
            ->withCount('votes')
            ->orderBy('serial_number')
            ->get()
            ->map(function (Candidate $candidate) use ($totalVotes) {
                $candidate->percentage = $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 1) : 0;

                return $candidate;
            });
    }
}
