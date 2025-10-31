<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:buyer,seller,admin'],
        ]);

        $roleMap = [
            'admin' => 1,
            'seller' => 2,
            'buyer' => 3,
        ];

        $role = $roleMap[$request->role];
        $status = ($role == 1) ? 'pending' : 'active';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'status' => $status,
        ]);

        event(new Registered($user));

        // if ($role == 2 && $status == 'active') { // Create store for approved seller
        //     $user->store()->create(['name' => $user->name . "'s Store"]);
        // }

        if ($status == 'pending') {
            return redirect()->route('login')->with('status', 'Registration successful! Your account is pending approval by an admin.');
        }

        Auth::login($user);

        // Redirect to role-based home page after registration
        if ($user->isAdmin()) {
            return redirect()->route('admin.home');
        } elseif ($user->isSeller()) {
            return redirect()->route('seller.home');
        } elseif ($user->isBuyer()) {
            return redirect()->route('buyer.home');
        }

        return redirect()->route('landing');
    }
}