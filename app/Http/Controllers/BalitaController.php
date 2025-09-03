<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    /**
     * Menampilkan semua data balita (publik) dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $balitas = Balita::with('user')
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
     * Detail data balita dengan relasi user dan measurements.
     */
    public function show(Balita $balita)
    {
        $balita->load(['user', 'measurements' => function ($q) {
            $q->orderBy('measurement_date', 'desc');
        }]);

        return view('balita.show', compact('balita'));
    }
}
