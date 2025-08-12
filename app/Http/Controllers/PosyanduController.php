<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    /**
     * Menampilkan semua data posyandu dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $query = Posyandu::query();

        // Logika untuk pencarian berdasarkan nama, desa, atau kecamatan
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('village', 'like', '%' . $request->search . '%')
                ->orWhere('sub_district', 'like', '%' . $request->search . '%');
        }

        $posyandus = $query->latest()->paginate(10);

        return view('layanan-kesehatan.index', ['posyandus' => $posyandus]);
    }
}
