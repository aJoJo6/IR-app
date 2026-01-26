<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'home'])->name('home');

Route::get('/explore', [AppController::class, 'explore'])->name('explore');
Route::get('/revolutions/{id}', [AppController::class, 'revolution'])->name('revolutions.show');

Route::get('/compare', [AppController::class, 'compare'])->name('compare');

Route::get('/criteria', [AppController::class, 'criteria'])->name('criteria');
Route::get('/evaluation', [AppController::class, 'evaluation'])->name('evaluation');

Route::get('/glossary', [AppController::class, 'glossary'])->name('glossary');
