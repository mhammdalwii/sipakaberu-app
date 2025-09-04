<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BalitaResource;
use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    public function index(Request $request)
    {
        $query = Balita::query()->with('user');
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        }

        $balitas = $query->latest()->paginate(10);

        return BalitaResource::collection($balitas);
    }

    public function measurements(Balita $balita)
    {
        $measurements = $balita->measurements()->orderBy('measurement_date')->get();

        return response()->json([
            'data' => [
                'id' => $balita->id,
                'name' => $balita->name,
                'date_of_birth' => $balita->date_of_birth,
                'gender' => $balita->gender,
                'address' => $balita->address,
                'parent' => $balita->parent,
                'first_measurement' => $measurements->first(),
                'last_measurement' => $measurements->last(),
                'measurements' => $measurements,
            ]
        ]);
    }
}
