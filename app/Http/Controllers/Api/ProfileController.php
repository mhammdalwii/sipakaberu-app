<?php

namespace App\Http\controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\http\Request;
use Illuminate\support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Mengembalikan data pengguna yang sedang login.
     */
    public function show(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Memperbarui profil pengguna.
     */
    public function update(ProfileUpdateRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // Ambil hanya data yang tervalidasi dari ProfileUpdateRequest
        $validatedData = $request->validated();

        // Logika untuk menangani upload foto profil jika ada
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            // Hapus key 'profile_photo' dari data validasi, ganti dengan path
            unset($validatedData['profile_photo']);
            $validatedData['profile_photo_path'] = $path;
        }

        // Update user dengan data yang sudah bersih
        $user->update($validatedData);

        // Kembalikan response sukses dengan data user terbaru
        return response()->json([
            'message' => 'Profil berhasil diperbarui!',
            'user' => new UserResource($user)
        ]);
    }
}
