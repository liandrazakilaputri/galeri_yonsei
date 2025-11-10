<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FotoController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Semua route API akan otomatis memiliki prefix "/api".
| Contoh akses: http://127.0.0.1:8000/api/fotos
|--------------------------------------------------------------------------
*/

// ===============================
// 🔐 AUTH (tanpa login)
// ===============================
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// ===============================
// 🌍 PUBLIC API (tidak butuh token)
// ===============================
Route::prefix('public')->group(function () {
    // Foto
    Route::get('/fotos', [FotoController::class, 'index']);
    Route::get('/fotos/{id}', [FotoController::class, 'show']);

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori/{id}', [KategoriController::class, 'show']);
});

// ===============================
// 🔑 PROTECTED API (butuh token login Sanctum)
// ===============================
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // CRUD Foto
    Route::apiResource('fotos', FotoController::class)->except(['index', 'show']);

    // CRUD Kategori
    Route::apiResource('kategori', KategoriController::class)->except(['index', 'show']);

    // CRUD User
    Route::apiResource('users', UserController::class);
});
