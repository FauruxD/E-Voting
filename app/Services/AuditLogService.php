<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class AuditLogService
{
    public function record(string $aksi, ?User $user = null, array $detail = [], ?Request $request = null): void
    {
        $request ??= request();

        AuditLog::create([
            'pengguna_id' => $user?->id,
            'aksi' => $aksi,
            'alamat_ip' => $request?->ip(),
            'agen_pengguna' => $request?->userAgent(),
            'detail' => $detail ?: null,
        ]);
    }
}
