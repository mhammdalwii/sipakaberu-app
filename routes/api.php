<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\MedicinalPlantController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\PosyanduController;
use App\Http\Controllers\Api\HelpCenterController;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\RecipeCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\BalitaController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/recipes', [RecipeController::class, 'index']);
    Route::get('/recipes/{recipe:slug}', [RecipeController::class, 'show']);
    Route::get('/recipe-categories', [RecipeCategoryController::class, 'index']);
    Route::get('/recipe-categories/{recipeCategory:slug}', [RecipeCategoryController::class, 'show']);
    Route::get('/education/categories', [EducationController::class, 'getCategories']);
    Route::get('/education/categories/{category:slug}', [EducationController::class, 'getPostsByCategory']);
    Route::get('/education/posts/{educationPost:slug}', [EducationController::class, 'showPost']);
    Route::get('/medicinal-plants', [MedicinalPlantController::class, 'index']);
    Route::get('/medicinal-plants/{medicinalPlant:slug}', [MedicinalPlantController::class, 'show']);
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::get('/appointments/history', [AppointmentController::class, 'history']);
    Route::get('/posyandus', [PosyanduController::class, 'index']);
    Route::get('/help-articles', [HelpCenterController::class, 'index']);
    Route::get('/help-articles/{helpArticle:slug}', [HelpCenterController::class, 'show']);
    Route::get('/consultations', [ConsultationController::class, 'index']);
    Route::post('/consultations', [ConsultationController::class, 'store']);
    Route::get('/consultations/{consultation}', [ConsultationController::class, 'show']);
    Route::post('/consultations/{consultation}/reply', [ConsultationController::class, 'reply']);
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead']);
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy']);
    // Route::post('/profile/update', [ProfileController::class, 'apiUpdate']);
    Route::get('/user', [\App\Http\Controllers\Api\ProfileController::class, 'show']);
    Route::post('/user/update', [\App\Http\Controllers\Api\ProfileController::class, 'update']);
    Route::get('/balitas', [BalitaController::class, 'index']);
});
