<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_urut',
        'nama_ketua',
        'nama_wakil',
        'jurusan',
        'prodi',
        'angkatan',
        'visi',
        'misi',
        'program_kerja',
        'foto',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'program_kerja' => 'array',
        ];
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'kandidat_id');
    }

    public function getPairNameAttribute(): string
    {
        return "{$this->nama_ketua} & {$this->nama_wakil}";
    }
}
