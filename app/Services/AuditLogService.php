<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class AuditLogService
{
    public function record(string $action, ?User $user = null, array $metadata = [], ?Request $request = null): void
    {
        $request ??= request();

        AuditLog::create([
            'user_id' => $user?->id,
            'action' => $action,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
            'metadata' => $metadata ?: null,
        ]);
    }
}
