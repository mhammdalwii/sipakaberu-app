<?php

namespace App\Http\Controllers;

use App\Models\MedicinalPlant;
use Illuminate\Http\Request;

class MedicinalPlantController extends Controller
{
    /**
     * Menampilkan halaman daftar semua tanaman obat.
     */
    public function index()
    {
        $plants = MedicinalPlant::latest()->paginate(12); // Ambil 12 tanaman per halaman
        return view('tanaman-obat.index', ['plants' => $plants]);
    }

    /**
     * Menampilkan satu halaman detail tanaman obat.
     */
    public function show(MedicinalPlant $medicinalPlant)
    {
        return view('tanaman-obat.show', ['plant' => $medicinalPlant]);
    }
}
