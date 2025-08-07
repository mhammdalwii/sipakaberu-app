<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Rute untuk menampilkan semua kategori edukasi
    Route::get('/edukasi', [EducationController::class, 'index'])->name('edukasi.index');
    // Rute untuk menampilkan semua video dalam satu kategori
    Route::get('/edukasi/{category:slug}', [EducationController::class, 'show'])->name('edukasi.show');
    // Rute untuk menampilkan satu postingan video
    Route::get('/post/{educationPost:slug}', [EducationController::class, 'showPost'])->name('edukasi.post.show');
    Route::get('/resep', [RecipeController::class, 'index'])->name('resep.index');
    Route::get('/resep/kategori/{recipeCategory:slug}', [RecipeController::class, 'showCategory'])->name('resep.category');
    Route::get('/resep/detail/{recipe:slug}', [RecipeController::class, 'show'])->name('resep.detail');
    Route::get('/jadwal', [AppointmentController::class, 'index'])->name('jadwal.index');
});

require __DIR__ . '/auth.php';
