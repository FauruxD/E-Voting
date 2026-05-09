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
            'nama_aplikasi' => ['required', 'string', 'max:255'],
            'judul_pemilihan' => ['required', 'string', 'max:255'],
            'status_voting' => ['required', 'in:open,closed'],
            'hasil_ditampilkan' => ['required', 'boolean'],
            'mulai_voting' => ['nullable', 'date'],
            'selesai_voting' => ['nullable', 'date', 'after_or_equal:mulai_voting'],
        ]);

        $setting = Setting::current();
        $setting->update($data);
        $auditLog->record('setting_updated', $request->user(), $data, $request);

        return redirect()->route('admin.settings.edit')->with('status', 'Pengaturan berhasil disimpan.');
    }
}
