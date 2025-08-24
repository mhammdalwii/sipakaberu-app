<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalitaController extends Controller
{
    /**
     * Menampilkan semua data balita (publik) dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $query = Balita::query();

        // Logika untuk pencarian berdasarkan nama balita atau nama orang tua
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        }

        // 'with('user')' untuk mengambil data orang tua secara efisien
        $balitas = $query->with('user')->latest()->paginate(10);

        return view('balita.index', ['balitas' => $balitas]);
    }
}
