<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicinalPlantResource;
use App\Models\MedicinalPlant;

class MedicinalPlantController extends Controller
{
    public function index()
    {
        $plants = MedicinalPlant::latest()->paginate(12);
        return MedicinalPlantResource::collection($plants);
    }

    public function show(MedicinalPlant $medicinalPlant)
    {
        return new MedicinalPlantResource($medicinalPlant);
    }
}
