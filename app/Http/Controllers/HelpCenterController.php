<?php

namespace App\Http\Controllers;

use App\Models\HelpArticle;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    /**
     * Menampilkan semua artikel bantuan.
     */
    public function index()
    {
        $articles = HelpArticle::latest()->get();
        return view('pusat-bantuan.index', ['articles' => $articles]);
    }
}
