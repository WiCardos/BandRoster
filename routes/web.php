<?php

use App\Http\Controllers\BandController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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