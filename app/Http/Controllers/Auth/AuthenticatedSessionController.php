<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user && $user->hasRole('admin')) {
            return redirect()->route('admin.dashboard.index');
        } elseif ($user && $user->hasRole('guru')) {
            return redirect()->route('guru.dashboard.index');
        } elseif ($user && $user->hasRole('orang_tua')) {
            return redirect()->route('orangTua.dashboard.index');
        } else {
            Auth::logout();
            return redirect()->route('login')->with('status', 'You are not authorized to access this page.');
        }


        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
