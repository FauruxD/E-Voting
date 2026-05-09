<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'setting' => Setting::current(),
        ]);
    }

    public function update(Request $request, AuditLogService $auditLog): RedirectResponse
    {
        $data = $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'election_title' => ['required', 'string', 'max:255'],
            'voting_status' => ['required', 'in:open,closed'],
            'result_visibility' => ['required', 'boolean'],
            'voting_start' => ['nullable', 'date'],
            'voting_end' => ['nullable', 'date', 'after_or_equal:voting_start'],
        ]);

        $setting = Setting::current();
        $setting->update($data);
        $auditLog->record('setting_updated', $request->user(), $data, $request);

        return redirect()->route('admin.settings.edit')->with('status', 'Pengaturan berhasil disimpan.');
    }
}
