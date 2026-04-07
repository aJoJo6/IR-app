<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

// home
Route::get('/', [AppController::class, 'home'])->name('home');

// revolutions
Route::prefix('revolutions')->group(function () {
    Route::get('/', [AppController::class, 'explore'])->name('revolutions.index');

    Route::get('/{id}', [AppController::class, 'revolution'])
        ->whereIn('id', ['ir1', 'ir2', 'ir3', 'ir4', 'ir5'])
        ->name('revolutions.show');
});

// analysis
Route::prefix('analysis')->group(function () {
    Route::get('/compare', [AppController::class, 'compare'])->name('analysis.compare');
    Route::get('/criteria', [AppController::class, 'criteria'])->name('analysis.criteria');
    Route::get('/evaluation', [AppController::class, 'evaluation'])->name('analysis.evaluation');
});

// reference
Route::get('/glossary', [AppController::class, 'glossary'])->name('glossary');