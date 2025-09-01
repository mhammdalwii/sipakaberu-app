<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\RecipeCategory;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with('recipeCategory');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $recipes = $query->latest()->paginate(10);
        return RecipeResource::collection($recipes);
    }

    public function show(Request $request, RecipeCategory $recipeCategory)
    {
        $query = $recipeCategory->recipes();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $recipes = $query->latest()->paginate(10);
        return RecipeResource::collection($recipes);
    }
}
