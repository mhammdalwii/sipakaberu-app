<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends Controller
{
    /**
     * Menampilkan semua jadwal yang akan datang.
     */
    public function index()
    {
        $appointments = Appointment::where('schedule_date', '>=', now())
            ->orderBy('schedule_date', 'asc')
            ->paginate(10);

        return view('jadwal.index', ['appointments' => $appointments]);
    }
    public function history()
    {
        // Ambil semua jadwal yang tanggalnya sudah lewat
        $appointments = Appointment::where('schedule_date', '<', now())
            // Urutkan dari yang paling baru selesai (descending)
            ->orderBy('schedule_date', 'desc')
            ->paginate(10);

        // Kembalikan data menggunakan resource yang sama
        return AppointmentResource::collection($appointments);
    }
}
