<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::controller(AppController::class)->group(function () {
    // Home
    Route::get('/', 'home')->name('home');

    // Revolutions
    Route::prefix('revolutions')->name('revolutions.')->group(function () {
        Route::get('/', 'explore')->name('index');
        Route::get('/{id}', 'revolution')->name('show');
        Route::get('/{id}/sections/{section}', 'revolutionSection')->name('section');
    });

    // Analysis
    Route::prefix('analysis')->name('analysis.')->group(function () {
        Route::get('/compare', 'compare')->name('compare');
        Route::get('/criteria', 'criteria')->name('criteria');
        Route::get('/evaluation', 'evaluation')->name('evaluation');
    });

    // Glossary
    Route::get('/glossary', 'glossary')->name('glossary');
});

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')
    ->prefix('admin')
    ->name('admin.')
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');

        // Revolutions
        Route::get('/revolutions/{revolution}/edit', 'editRevolution')->name('revolutions.edit');
        Route::put('/revolutions/{revolution}', 'updateRevolution')->name('revolutions.update');

        // Sections
        Route::get('/sections/{section}/edit', 'editSection')->name('sections.edit');
        Route::put('/sections/{section}', 'updateSection')->name('sections.update');

        // Criteria
        Route::get('/criteria', 'criteria')->name('criteria');
        Route::get('/criteria/create', 'createCriterion')->name('criteria.create');
        Route::post('/criteria', 'storeCriterion')->name('criteria.store');
        Route::get('/criteria/{criterion}/edit', 'editCriterion')->name('criteria.edit');
        Route::put('/criteria/{criterion}', 'updateCriterion')->name('criteria.update');

        // Evaluation
        Route::get('/evaluation', 'evaluation')->name('evaluation');
        Route::post('/evaluation', 'storeEvaluationCriterion')->name('evaluation.store');
        Route::put('/evaluation', 'updateEvaluationMatrix')->name('evaluation.update');
        Route::get('/evaluation/{evaluation}/edit', 'editEvaluation')->name('evaluation.edit');
        Route::put('/evaluation/{evaluation}', 'updateEvaluation')->name('evaluation.item.update');
        Route::delete('/evaluation/{criterion}', 'destroyEvaluationCriterion')->name('evaluation.destroy');

        // Glossary
        Route::get('/glossary', 'glossary')->name('glossary');
        Route::get('/glossary/create', 'createGlossary')->name('glossary.create');
        Route::post('/glossary', 'storeGlossary')->name('glossary.store');
        Route::get('/glossary/{term}/edit', 'editGlossary')->name('glossary.edit');
        Route::put('/glossary/{term}', 'updateGlossary')->name('glossary.update');
    });