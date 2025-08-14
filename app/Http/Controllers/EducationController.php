<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\EducationPost;

class EducationController extends Controller
{
    /**
     * Menampilkan halaman daftar kategori edukasi.
     */
    public function index()
    {
        // Ambil semua kategori, dan untuk setiap kategori, ambil hingga 10 postingan edukasi terbaru.
        $categories = Category::with(['educationPosts' => function ($query) {
            $query->latest()->limit(10);
        }])->get();

        return view('edukasi.index', ['categories' => $categories]);
    }

    /**
     * Menampilkan postingan video dalam satu kategori spesifik.
     */
    public function show(Category $category)
    {
        $posts = $category->educationPosts()->latest()->paginate(12);

        return view('edukasi.show', [
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function showPost(EducationPost $educationPost)
    {
        return view('edukasi.show_post', ['post' => $educationPost]);
    }
}
