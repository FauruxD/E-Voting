<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_name',
        'election_title',
        'voting_status',
        'result_visibility',
        'voting_start',
        'voting_end',
    ];

    protected function casts(): array
    {
        return [
            'result_visibility' => 'boolean',
            'voting_start' => 'datetime',
            'voting_end' => 'datetime',
        ];
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'app_name' => 'BEM E-Voting',
            'election_title' => 'Pemilihan Umum BEM 2026',
            'voting_status' => 'closed',
            'result_visibility' => false,
        ]);
    }

    public function isVotingOpen(): bool
    {
        $now = now();

        if ($this->voting_status !== 'open') {
            return false;
        }

        if ($this->voting_start && $now->lt($this->voting_start)) {
            return false;
        }

        if ($this->voting_end && $now->gt($this->voting_end)) {
            return false;
        }

        return true;
    }
}
