<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewConsultationMessage;


class ConsultationController extends Controller
{
    // Menampilkan daftar semua konsultasi milik user
    public function index()
    {
        $consultations = Auth::user()->consultations()->latest()->paginate(10);
        return view('konsultasi.index', ['consultations' => $consultations]);
    }

    // Menampilkan form untuk membuat konsultasi baru
    public function create()
    {
        return view('konsultasi.create');
    }

    // Menyimpan konsultasi baru
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Buat konsultasi baru
        $consultation = Auth::user()->consultations()->create([
            'subject' => $request->subject,
        ]);

        // Buat pesan pertama di dalam konsultasi tersebut
        $message = $consultation->messages()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);
        broadcast(new NewConsultationMessage($message))->toOthers();

        return redirect()->route('konsultasi.show', $consultation);
    }

    // Menampilkan satu percakapan konsultasi
    public function show(Consultation $consultation)
    {
        // Pastikan user hanya bisa melihat konsultasi miliknya sendiri
        if ($consultation->user_id !== Auth::id()) {
            abort(403);
        }
        return view('konsultasi.show', ['consultation' => $consultation]);
    }

    // Menyimpan balasan dari user
    public function reply(Request $request, Consultation $consultation)
    {
        if ($consultation->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate(['body' => 'required|string']);

        $message = $consultation->messages()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        broadcast(new NewConsultationMessage($message))->toOthers();
        return back()->with('status', 'Pesan berhasil dikirim.');
    }
}
