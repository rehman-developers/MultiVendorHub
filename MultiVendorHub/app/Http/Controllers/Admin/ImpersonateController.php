<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    public function impersonate(User $user)
    {
        if (Auth::user()->role != 0) { // Only Super Admin
            abort(403);
        }

        session()->put('impersonate', Auth::user()->id); // Save original ID
        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Now impersonating ' . $user->name);
    }

    public function stop()
    {
        $originalId = session()->pull('impersonate');
        if ($originalId) {
            Auth::login(User::find($originalId));
            return redirect()->route('admin.dashboard')->with('success', 'Back to original account');
        }

        abort(403);
    }
}