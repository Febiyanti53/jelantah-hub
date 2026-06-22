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
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'string', 'in:pengepul,masyarakat'], 
        
        // Ubah dari 'required' menjadi 'nullable'
        'latitude' => ['nullable', 'numeric', 'between:-90,90'],
        'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        'address' => ['nullable', 'string', 'max:500'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role, 
        
        // Data ini akan bernilai null jika tidak dikirim
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'address' => $request->address,
    ]);

        event(new Registered($user));

        Auth::login($user);

        return match ($user->role) {
            'pengepul' => redirect('/pengepul/dashboard'),
            'masyarakat' => redirect('/masyarakat/dashboard'),
            default => redirect('/dashboard'),
        };
    }
}