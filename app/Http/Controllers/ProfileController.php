<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->password === null) {
            unset($request->user()->password);
        }

        if ($request->user()->isDirty('picture')) {
            $originalPicture = $request->user()->getOriginal('picture');

            if ($originalPicture !== null) {
                Storage::delete($originalPicture);
            }
            
            $request->user()->picture = $request->picture->store('profile-pics');
        }

        $request->user()->save();

        return redirect(route('profile.edit'))->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        if ($user->picture !== null) {
            Storage::delete($user->picture);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'))->with([
            'status' => 'profile-destroyed',
            'info' => 'alert',
            'msg' => 'Akun berhasil dihapus.'
        ]);
    }
}
