<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        if ($user->status != 'active') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is pending approval by an admin.');
        }

        // Redirect to role-based home page after login
        if($user->isSuperAdmin()) {
            return redirect()->route('admin.home');
        }
        elseif ($user->isAdmin()) {
            return redirect()->route('admin.home');
        } elseif ($user->isSeller()) {
            return redirect()->route('seller.home');
        } elseif ($user->isBuyer()) {
            return redirect()->route('buyer.home');
        }

        return redirect()->route('landing');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}