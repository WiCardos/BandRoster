<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/**
 * Bands
 */

// Home page publica
Route::get('/', [BandController::class, 'index'])->name('bands.index');

// Dashboard para autenticados
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// SErviços do admin
// band/create tem que estar definido antes de band/{band}
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/bands/create', [BandController::class, 'create'])->name('bands.create');
    Route::post('/bands', [BandController::class, 'store'])->name('bands.store');
    Route::delete('/bands/{band}', [BandController::class, 'destroy'])->name('bands.destroy');
});

// Serviços de users autenticados (incluindo admin)
Route::middleware('auth')->group(function () {
    Route::get('/bands/{band}/edit', [BandController::class, 'edit'])->name('bands.edit');
    Route::put('/bands/{band}', [BandController::class, 'update'])->name('bands.update');
});

/**
* Albuns
*/

// Todos os albuns por banda, para todos os users
Route::get('/bands/{band}/albums', [AlbumController::class, 'index'])->name('bands.albums.index');

// Serviços de Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/bands/{band}/albums/create', [AlbumController::class, 'create'])->name('bands.albums.create');
    Route::post('/bands/{band}/albums', [AlbumController::class, 'store'])->name('bands.albums.store');
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');
});

// Serviços de users autenticados (incluindo admin)
Route::middleware('auth')->group(function () {
    Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
});


/**
 * Exporting (PDF, CSV, JSON)
 */
Route::get('/bands/{band}/export/pdf', [BandController::class, 'exportPdf'])->name('bands.export.pdf');
Route::get('/bands/{band}/export/csv', [BandController::class, 'exportCsv'])->name('bands.export.csv');
Route::get('/bands/{band}/export/json', [BandController::class, 'exportJson'])->name('bands.export.json');

//fallback
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
