<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'chairman_name',
        'vice_name',
        'faculty',
        'major',
        'batch',
        'vision',
        'mission',
        'work_programs',
        'photo',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'work_programs' => 'array',
        ];
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function getPairNameAttribute(): string
    {
        return "{$this->chairman_name} & {$this->vice_name}";
    }
}
