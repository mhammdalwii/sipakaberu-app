<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\HelpArticleResource;
use App\Models\HelpArticle;

class HelpCenterController extends Controller
{
    /**
     * Daftar artikel bantuan dengan optional search
     */
    public function index(Request $request)
    {
        $query = HelpArticle::query();

        // Jika ada parameter search, filter berdasarkan title atau content
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        }

        $articles = $query->latest()->get();

        return HelpArticleResource::collection($articles);
    }

    /**
     * Detail artikel berdasarkan slug
     */
    public function show(HelpArticle $helpArticle)
    {
        return new HelpArticleResource($helpArticle);
    }
}
