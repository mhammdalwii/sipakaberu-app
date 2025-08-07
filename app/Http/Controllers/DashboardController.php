<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil 1 jadwal yang akan datang (tanggalnya lebih besar atau sama dengan hari ini),
        // diurutkan dari yang paling dekat, dan hanya ambil yang pertama.
        $upcomingAppointment = Appointment::where('schedule_date', '>=', now())
            ->orderBy('schedule_date', 'asc')
            ->first();

        // Kirim data jadwal ke view dashboard
        return view('dashboard', ['upcomingAppointment' => $upcomingAppointment]);
    }
}
