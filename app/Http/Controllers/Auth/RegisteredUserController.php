<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        dd($request->all());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $reference_code = $request->role === 'Master' || 'master' ? 'BPM-'.  Str::upper($request->initial_name) . '-' . random_int(1000,9999) : 'BPA-' .  Str::upper($request->initial_name) . '-' . random_int(1000,9999);

        do {
            // $reference_code = 'BPM-' . Str::upper($request->initial_name) . '-' . random_int(1000, 9999);
            $reference_code = $request->role == 'Master' ? 'BPM-' .  Str::upper($request->initial_name) . '-' . random_int(1000, 9999) : 'BPA-' .  Str::upper($request->initial_name) . '-' . random_int(1000, 9999);
        } while (User::where('reference_code', $reference_code)->exists());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'reference_code' => $reference_code,
            'role' => $request->role,
            'status' => 1
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
