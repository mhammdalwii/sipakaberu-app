<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    /**
     * Menampilkan semua data balita (publik) dengan fitur pencarian
     * + hanya ambil pengukuran terakhir agar lebih efisien.
     */
    public function index(Request $request)
    {
        $balitas = Balita::with([
            'user',
            'measurements' => function ($q) {
                $q->latest('measurement_date')->limit(1); // hanya ambil pengukuran terakhir
            }
        ])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($sub) use ($search) {
                            $sub->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10);

        return view('balita.index', compact('balitas'));
    }

    /**
     * Detail data balita dengan relasi user dan semua riwayat measurements.
     */
    public function show(Balita $balita)
    {
        $balita->load([
            'user',
            'measurements' => function ($q) {
                $q->orderBy('measurement_date', 'desc');
            }
        ]);

        return view('balita.show', compact('balita'));
    }
}
