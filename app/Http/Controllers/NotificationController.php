<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;



class NotificationController extends Controller
{
    public function index()
    {
        // Ambil semua notifikasi milik user yang sedang login
        $notifications = Auth::user()->notifications()->latest()->paginate(15);

        // Cari notifikasi user ini yang kolom 'read_at'-nya masih kosong,
        // lalu update kolom tersebut dengan waktu sekarang.
        Auth::user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return view('notifikasi.index', ['notifications' => $notifications]);
    }
    public function destroy(Notification $notification)
    {
        // PENTING: Pengecekan keamanan agar user tidak bisa menghapus notifikasi orang lain.
        if (auth()->id() !== $notification->user_id) {
            abort(403); // Akses ditolak
        }

        $notification->delete();

        return back()->with('status', 'Notifikasi berhasil dihapus.');
    }
}
