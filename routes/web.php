<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Admin\AuthController;
use App\Admin\CatalogController;

// simple probe route
Route::get('/probe', fn() => 'probe-ok');

// ── HALAMAN PUBLIK ─────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/item/{catalogItem}', [HomeController::class, 'show'])->name('item.show');

// ── ADMIN: LOGIN ───────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ── ADMIN: HALAMAN TERPROTEKSI ─────────────────────
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {

        Route::get('/',                    [CatalogController::class, 'index'])->name('dashboard');
        Route::get('/item/create',         [CatalogController::class, 'create'])->name('item.create');
        Route::post('/item',               [CatalogController::class, 'store'])->name('item.store');
        Route::get('/item/{item}/edit',    [CatalogController::class, 'edit'])->name('item.edit');
        Route::put('/item/{item}',         [CatalogController::class, 'update'])->name('item.update');
        Route::delete('/item/{item}',      [CatalogController::class, 'destroy'])->name('item.destroy');
        Route::get('/item/{item}/preview', [CatalogController::class, 'preview'])->name('item.preview');
        Route::get('/item/{item}/duplicate', [CatalogController::class, 'duplicate'])->name('item.duplicate');

    });
});