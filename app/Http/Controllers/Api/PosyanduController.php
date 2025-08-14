<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PosyanduResource;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    public function index(Request $request)
    {
        $query = Posyandu::query();

        // Logika untuk pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('village', 'like', '%' . $request->search . '%')
                ->orWhere('sub_district', 'like', '%' . $request->search . '%');
        }

        $posyandus = $query->latest()->paginate(10);

        return PosyanduResource::collection($posyandus);
    }
}
