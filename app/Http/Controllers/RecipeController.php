<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Menampilkan halaman utama resep yang dikelompokkan per kategori.
     */
    public function index()
    {
        $recipeCategories = RecipeCategory::with(['recipes' => function ($query) {
            $query->latest()->limit(5);
        }])->get();

        return view('resep.index', ['recipeCategories' => $recipeCategories]);
    }

    /**
     * Menampilkan semua resep dalam satu kategori dengan pagination.
     */
    public function showCategory(RecipeCategory $recipeCategory)
    {
        $recipes = $recipeCategory->recipes()->latest()->paginate(9);
        return view('resep.category', [
            'category' => $recipeCategory,
            'recipes' => $recipes,
        ]);
    }

    /**
     * Menampilkan satu halaman detail resep.
     */
    public function show(Recipe $recipe)
    {
        return view('resep.show', ['recipe' => $recipe]);
    }
}
