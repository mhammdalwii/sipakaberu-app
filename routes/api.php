<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\MedicinalPlantController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\PosyanduController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/recipes', [RecipeController::class, 'index']);
    Route::get('/recipes/{recipe:slug}', [RecipeController::class, 'show']);
    Route::get('/education/categories', [EducationController::class, 'getCategories']);
    Route::get('/education/categories/{category:slug}', [EducationController::class, 'getPostsByCategory']);
    Route::get('/education/posts/{educationPost:slug}', [EducationController::class, 'showPost']);
    Route::get('/medicinal-plants', [MedicinalPlantController::class, 'index']);
    Route::get('/medicinal-plants/{medicinalPlant:slug}', [MedicinalPlantController::class, 'show']);
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::get('/posyandus', [PosyanduController::class, 'index']);
});
