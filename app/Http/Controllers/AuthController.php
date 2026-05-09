<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function loginPage(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('auth.login', [
            'setting' => Setting::current(),
        ]);
    }

    public function login(Request $request, AuditLogService $auditLog): RedirectResponse
    {
        $credentials = $request->validate([
            'npm' => ['required', 'string'],
            'pin' => ['required', 'string'],
            'remember' => ['nullable'],
        ]);

        $user = User::where('npm', $credentials['npm'])->first();

        if (! $user || $user->pin !== $credentials['pin'] || ! $user->aktif) {
            $auditLog->record('login_failed', $user, ['npm' => $credentials['npm']], $request);

            return back()
                ->withErrors(['npm' => 'NPM atau PIN tidak sesuai, atau akun tidak aktif.'])
                ->onlyInput('npm');
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();
        $auditLog->record('login_success', $user, [], $request);

        return $this->redirectByRole($user);
    }

    public function logout(Request $request, AuditLogService $auditLog): RedirectResponse
    {
        $user = $request->user();

        if ($user) {
            $auditLog->record('logout', $user, [], $request);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectByRole(User $user): RedirectResponse
    {
        return $user->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('voter.dashboard');
    }
}
