<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->fill($request->validated());
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
}
