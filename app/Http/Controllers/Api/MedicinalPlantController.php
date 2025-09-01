<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicinalPlantResource;
use App\Models\MedicinalPlant;
use Illuminate\Http\Request; // <-- TAMBAHKAN IMPORT INI

class MedicinalPlantController extends Controller
{
    public function index(Request $request) // <-- TAMBAHKAN Request $request
    {
        // Gunakan query builder untuk menambahkan kondisi secara dinamis
        $plants = MedicinalPlant::query()
            ->when($request->search, function ($query, $search) {
                // Jika ada parameter 'search', tambahkan kondisi WHERE LIKE
                return $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12);

        return MedicinalPlantResource::collection($plants);
    }

    public function show(MedicinalPlant $medicinalPlant)
    {
        return new MedicinalPlantResource($medicinalPlant);
    }
}