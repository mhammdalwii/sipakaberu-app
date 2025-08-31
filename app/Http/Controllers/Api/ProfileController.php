<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    /**
     * Menampilkan data user yang sedang login.
     * Ini akan menggantikan fungsi di file api.php
     */
    public function show(Request $request)
    {
        // Menambahkan type-hint untuk membantu editor kode
        /** @var \App\Models\User $user */
        $user = $request->user();
        return new UserResource($user);
    }

    /**
     * Mengupdate data user yang sedang login.
     * Ini adalah logika utama untuk endpoint update Anda.
     */
    public function update(Request $request)
    {
        // Menambahkan type-hint untuk membantu editor kode
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validasi semua data yang masuk dari aplikasi
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'phone' => ['sometimes', 'string', 'max:15', Rule::unique('users')->ignore($user->id)],
            'date_of_birth' => 'sometimes|date',
            'gender' => 'sometimes|string|in:Laki-laki,Perempuan',
            'address' => 'sometimes|string',
            'profile_photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk foto
        ]);

        // 2. Logika untuk menangani upload foto profil jika ada
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            // Simpan foto baru dan dapatkan path-nya
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validatedData['profile_photo_path'] = $path;
        }

        // 3. Update data user di database
        $user->update($validatedData);

        // 4. Kembalikan data user yang sudah diperbarui
        return response()->json([
            'message' => 'Profil berhasil diperbarui!',
            'user' => new UserResource($user->fresh()) // Ambil data terbaru dari database
        ]);
    }
}
