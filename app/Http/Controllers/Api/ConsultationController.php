<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Auth::user()->consultations()->latest()->paginate(10);
        return ConsultationResource::collection($consultations);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $consultation = Auth::user()->consultations()->create(['subject' => $validated['subject']]);
        $consultation->messages()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        return new ConsultationResource($consultation->load('messages'));
    }

    public function show(Consultation $consultation)
    {
        $this->authorize('view', $consultation);
        return new ConsultationResource($consultation->load('messages'));
    }

    public function reply(Request $request, Consultation $consultation)
    {
        $this->authorize('update', $consultation);

        $validated = $request->validate(['body' => 'required|string']);

        $message = $consultation->messages()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        return response()->json(['message' => 'Pesan berhasil dikirim.', 'data' => $message]);
    }
}
