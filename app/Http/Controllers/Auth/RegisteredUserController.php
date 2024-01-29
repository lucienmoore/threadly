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
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25', 'unique:users'],
            'email' => 'required|string|lowercase|email|max:50|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar' => 'nullable|mimes:jpeg,png|image',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->avatar
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $filename = $user->id . '.jpg'; 
            $avatarPath = $request->file('avatar')->storeAs('avatars', $filename, 'public');
    
            $path = storage_path('app/public/' . $avatarPath);
            if (filesize($path) > 10) {
                ImageOptimizer::optimize($path);
            }
    
            $user->update(['avatar' => $avatarPath]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
