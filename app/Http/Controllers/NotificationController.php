<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
}
