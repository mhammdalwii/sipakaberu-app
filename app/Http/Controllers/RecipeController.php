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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = RecipeCategory::query();

        // Muat relasi resep, tapi filter resep yang dimuat jika ada pencarian
        $query->with(['recipes' => function ($recipeQuery) use ($search) {
            if ($search) {
                $recipeQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            }
            // Tetap batasi preview di halaman utama
            $recipeQuery->latest()->limit(5);
        }]);

        // Jika ada pencarian, hanya tampilkan kategori yang memiliki resep yang cocok
        if ($search) {
            $query->whereHas('recipes', function ($recipeQuery) use ($search) {
                $recipeQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $recipeCategories = $query->get();

        // Kirim variabel yang benar ke view
        return view('resep.index', ['recipeCategories' => $recipeCategories]);
    }

    /**
     * Menampilkan semua resep dalam satu kategori dengan pagination.
     */
    public function showCategory(Request $request, RecipeCategory $recipeCategory)
    {
        $query = $recipeCategory->recipes();

        // Logika pencarian yang sama di dalam kategori
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $recipes = $query->latest()->paginate(9);

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
