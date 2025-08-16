<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\HelpArticleResource;
use App\Models\HelpArticle;

class HelpCenterController extends Controller
{
    public function index()
    {
        $articles = HelpArticle::latest()->get();
        return HelpArticleResource::collection($articles);
    }

    public function show(HelpArticle $helpArticle)
    {
        return new HelpArticleResource($helpArticle);
    }
}
