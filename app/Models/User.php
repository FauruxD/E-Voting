<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'npm',
        'nama',
        'jurusan',
        'prodi',
        'pin',
        'peran',
        'sudah_memilih',
        'aktif',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sudah_memilih' => 'boolean',
            'aktif' => 'boolean',
        ];
    }

    public function vote(): HasOne
    {
        return $this->hasOne(Vote::class, 'pemilih_id');
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class, 'pengguna_id');
    }

    public function isAdmin(): bool
    {
        return $this->peran === 'admin';
    }

    public function isVoter(): bool
    {
        return $this->peran === 'voter';
    }
}
