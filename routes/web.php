<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminKomentarController;
use App\Http\Controllers\AgendaController;

/*
|---------------------------------------------------------------------------
| ROUTE UNTUK USER (PUBLIC)
|---------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman tentang
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');

// 🔹 Agenda (khusus user, hanya bisa lihat)
Route::get('/agenda', [AgendaController::class, 'indexUser'])->name('agenda.index');
Route::get('/agenda/{agenda}', [AgendaController::class, 'show'])->name('agenda.show');

// Halaman galeri (user)
Route::get('/galeri', [FotoController::class, 'userGaleri'])->name('galeri');
Route::get('/galeri/{foto}', [FotoController::class, 'show'])->name('galeri.show');

// Komentar di halaman Home (tanpa login)
Route::post('/home/komentar', [HomeController::class, 'storeKomentar'])->name('home.komentar.store');

// Load more foto AJAX
Route::get('/home/load-more', [HomeController::class, 'loadMore'])->name('home.loadMore');

// Rating foto tanpa login
Route::post('/galeri/{foto}/rating', [FotoController::class, 'storeRating'])->name('rating.store');

// Download foto tanpa login
Route::get('/galeri/{foto}/download', [FotoController::class, 'download'])->name('galeri.download');

// Update rating via AJAX tanpa login
Route::post('/home/rating/{foto}', [HomeController::class, 'updateRating'])->name('home.rating.update');

/*
|---------------------------------------------------------------------------
| LOGIN / LOGOUT ADMIN
|---------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|---------------------------------------------------------------------------
| ROUTE ADMIN (HARUS LOGIN)
|---------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function() {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // CRUD Galeri
    Route::resource('galeri', FotoController::class)->names([
        'index' => 'galeri.index',
        'create' => 'galeri.create',
        'store' => 'galeri.store',
        'edit' => 'galeri.edit',
        'update' => 'galeri.update',
        'destroy' => 'galeri.destroy',
    ]);

    // Komentar & Rating
    Route::get('/komentar', [AdminKomentarController::class, 'index'])->name('komentar.index');
    Route::delete('/komentar/home/{id}', [AdminKomentarController::class, 'destroyKomentarHome'])->name('komentar.destroyHome');
    Route::delete('/komentar/rating/{id}', [AdminKomentarController::class, 'destroyRating'])->name('komentar.destroyRating');

    // CRUD Kategori
    Route::resource('kategori', KategoriController::class)->names([
        'index' => 'kategori.index',
        'create' => 'kategori.create',
        'store' => 'kategori.store',
        'edit' => 'kategori.edit',
        'update' => 'kategori.update',
        'destroy' => 'kategori.destroy',
    ]);

    // CRUD Users
    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);

    // 🔹 CRUD AGENDA (Admin)
    Route::get('/agenda', [AgendaController::class, 'indexAdmin'])->name('agenda.index');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
});
