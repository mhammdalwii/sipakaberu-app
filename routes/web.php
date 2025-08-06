<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EducationController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
});

require __DIR__ . '/auth.php';
