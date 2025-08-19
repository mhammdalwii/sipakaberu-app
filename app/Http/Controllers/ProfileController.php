<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Ambil user yang sedang login
        $user = $request->user();

        // Isi data user dengan data yang sudah tervalidasi dari ProfileUpdateRequest
        $user->fill($request->validated());

        // Jika user mengubah emailnya, reset status verifikasi email
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // 2. Simpan foto baru di folder 'storage/app/public/profile-photos'
            $path = $request->file('profile_photo')->store('profile-photos', 'public');

            // 3. Simpan path foto baru ke database
            $user->profile_photo_path = $path;
        }
        $user->save();
        $statusMessage = $request->hasFile('profile_photo') ? 'photo-updated' : 'profile-updated';
        return Redirect::route('profile.edit')->with('status', $statusMessage);
    }
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
