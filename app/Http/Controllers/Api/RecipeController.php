<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::latest()->paginate(10);
        return RecipeResource::collection($recipes);
    }

    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);
    }
}
