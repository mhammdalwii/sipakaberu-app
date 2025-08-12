<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicinalPlantController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
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
    Route::get('/tanaman-obat', [MedicinalPlantController::class, 'index'])->name('tanaman-obat.index');
    Route::get('/tanaman-obat/{medicinalPlant:slug}', [MedicinalPlantController::class, 'show'])->name('tanaman-obat.show');
    Route::get('/layanan-kesehatan', [PosyanduController::class, 'index'])->name('layanan-kesehatan.index');
    Route::get('/pusat-bantuan', [HelpCenterController::class, 'index'])->name('pusat-bantuan.index');
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi.index');
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
});

require __DIR__ . '/auth.php';
