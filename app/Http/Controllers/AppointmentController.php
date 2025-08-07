<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

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
}
