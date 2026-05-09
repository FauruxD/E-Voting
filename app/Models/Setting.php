<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_aplikasi',
        'judul_pemilihan',
        'status_voting',
        'hasil_ditampilkan',
        'mulai_voting',
        'selesai_voting',
    ];

    protected function casts(): array
    {
        return [
            'hasil_ditampilkan' => 'boolean',
            'mulai_voting' => 'datetime',
            'selesai_voting' => 'datetime',
        ];
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'nama_aplikasi' => 'BEM E-Voting',
            'judul_pemilihan' => 'Pemilihan Umum BEM 2026',
            'status_voting' => 'closed',
            'hasil_ditampilkan' => false,
        ]);
    }

    public function isVotingOpen(): bool
    {
        $now = now();

        if ($this->status_voting !== 'open') {
            return false;
        }

        if ($this->mulai_voting && $now->lt($this->mulai_voting)) {
            return false;
        }

        if ($this->selesai_voting && $now->gt($this->selesai_voting)) {
            return false;
        }

        return true;
    }
}
