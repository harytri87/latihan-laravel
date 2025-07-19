<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'min:4', 'max:255'],
            'username' => ['required', 'min:4', 'max:50', 'unique:'.User::class],
            'email' => ['required', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::min(6)],
            'picture' => [File::types(['png', 'jpg', 'webp'])->max(5 * 1024)],
        ]);

        if ($request->has('picture')) {
            // Ngupload foto & ngasih lokasinya buat ke database
            $attributes['picture'] = $request->picture->store('profile-pics');
        } else {
            // Foto kosong, field di databasenya null
            $attributes['picture'] = null;
        }
        
        $user = User::create($attributes);

        Auth::login($user);

        return redirect(route('home'));
    }
}
