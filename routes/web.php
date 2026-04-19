<?php

use App\Http\Controllers\AdminController; // admin controller
use App\Http\Controllers\AppController; // app controller
use Illuminate\Support\Facades\Route; // route facade

Route::controller(AppController::class)->group(function () { // public routes
    Route::get('/', 'home')->name('home'); // home page

    Route::prefix('revolutions')->name('revolutions.')->group(function () { // revolutions group
        Route::get('/', 'explore')->name('index'); // list revolutions
        Route::get('/{id}', 'revolution')->name('show'); // show revolution
        Route::get('/{id}/sections/{section}', 'revolutionSection')->name('section'); // show section
    });

    Route::prefix('analysis')->name('analysis.')->group(function () { // analysis group
        Route::get('/compare', 'compare')->name('compare'); // compare page
        Route::get('/criteria', 'criteria')->name('criteria'); // criteria page
        Route::get('/evaluation', 'evaluation')->name('evaluation'); // evaluation page
    });

    Route::get('/glossary', 'glossary')->name('glossary'); // glossary page
});

Route::prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () { // admin auth routes
    Route::get('/login', 'loginForm')->name('login'); // login form
    Route::post('/login', 'login')->name('login.post'); // login submit
    Route::post('/logout', 'logout')->name('logout'); // logout
});

Route::middleware('admin') // admin middleware
    ->prefix('admin') // admin prefix
    ->name('admin.') // admin naming
    ->controller(AdminController::class) // admin controller
    ->group(function () { // protected admin routes
        Route::get('/', 'index')->name('index'); // dashboard

        // revolutions
        Route::get('/revolutions/{revolution}/edit', 'editRevolution')->name('revolutions.edit'); // edit revolution
        Route::put('/revolutions/{revolution}', 'updateRevolution')->name('revolutions.update'); // update revolution

        // sections
        Route::get('/sections/{section}/edit', 'editSection')->name('sections.edit'); // edit section
        Route::put('/sections/{section}', 'updateSection')->name('sections.update'); // update section
        Route::post('/sections/{section}/images', 'addSectionImages')->name('sections.images.store'); // add images
        Route::delete('/section-images/{image}', 'deleteSectionImage')->name('sections.images.destroy'); // delete image

        // criteria
        Route::get('/criteria', 'criteria')->name('criteria'); // list criteria
        Route::get('/criteria/create', 'createCriterion')->name('criteria.create'); // create form
        Route::post('/criteria', 'storeCriterion')->name('criteria.store'); // store
        Route::get('/criteria/{criterion}/edit', 'editCriterion')->name('criteria.edit'); // edit form
        Route::put('/criteria/{criterion}', 'updateCriterion')->name('criteria.update'); // update

        // evaluation
        Route::get('/evaluation', 'evaluation')->name('evaluation'); // evaluation page
        Route::post('/evaluation', 'storeEvaluationCriterion')->name('evaluation.store'); // store evaluation
        Route::put('/evaluation/matrix', 'updateEvaluationMatrix')->name('evaluation.matrix.update'); // update matrix
        Route::put('/evaluation/{evaluation}/value', 'updateEvaluationValue')->name('evaluation.update.value'); // update value
        Route::get('/evaluation/{evaluation}/edit', 'editEvaluation')->name('evaluation.edit'); // edit form
        Route::put('/evaluation/{evaluation}', 'updateEvaluation')->name('evaluation.item.update'); // update item
        Route::delete('/evaluation/{criterion}', 'destroyEvaluationCriterion')->name('evaluation.destroy'); // delete

        // glossary
        Route::get('/glossary', 'glossary')->name('glossary'); // list glossary
        Route::get('/glossary/create', 'createGlossary')->name('glossary.create'); // create form
        Route::post('/glossary', 'storeGlossary')->name('glossary.store'); // store
        Route::get('/glossary/{term}/edit', 'editGlossary')->name('glossary.edit'); // edit form
        Route::put('/glossary/{term}', 'updateGlossary')->name('glossary.update'); // update
    });