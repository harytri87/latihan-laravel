<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
			'email'    => ['required', 'email'],
			'password' => ['required']
		]);

        $throttleKey = Str::transliterate(Str::lower($attributes['email']) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'password' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ])
            ]);
        }

        if (! Auth::attempt($attributes)) {
            RateLimiter::hit($throttleKey);

            throw ValidationException::withMessages([
                'password' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($throttleKey);
        request()->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
