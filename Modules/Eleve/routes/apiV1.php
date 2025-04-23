<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Eleve\App\Http\Controllers\Api\V1\{ AnneeController, ClasseController, EleveController, InscriptionController };

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

// Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
//     Route::get('eleve', fn (Request $request) => $request->user())->name('eleve');
// });

Route::group(['as' => 'shule::api.', 'prefix' => 'eleve'], function () {

    Route::controller(AnneeController::class)->group(function () {
        Route::get('/annee', 'index')->name('annee.index');
        Route::post('/annee', 'store')->name('annee.store');
        Route::get('/annee/{id}', 'show')->name('annee.show');
        Route::get('/annee/{id}', 'edit')->name('annee.edit');
        Route::post('/annee/{id}', 'update')->name('annee.update');
        Route::delete('/annee/{id}', 'destroy')->name('annee.destroy');
    });

    Route::controller(ClasseController::class)->group(function () {
        Route::get('/classe', 'index')->name('classe.index');
        Route::post('/classe', 'store')->name('classe.store');
        Route::get('/classe/{id}', 'show')->name('classe.show');
        Route::get('/classe/{id}', 'edit')->name('classe.edit');
        Route::post('/classe/{id}', 'update')->name('classe.update');
        Route::delete('/classe/{id}', 'destroy')->name('classe.destroy');
    });

    Route::controller(EleveController::class)->group(function () {
        Route::get('/eleve', 'index')->name('eleve.index');
        Route::post('/eleve', 'store')->name('eleve.store');
        Route::get('/eleve/{id}', 'show')->name('eleve.show');
        Route::get('/eleve/{id}', 'edit')->name('eleve.edit');
        Route::post('/eleve/{id}', 'update')->name('eleve.update');
        Route::delete('/eleve/{id}', 'destroy')->name('eleve.destroy');
    });

    Route::controller(InscriptionController::class)->group(function () {
        Route::get('/inscription', 'index')->name('inscription.index');
        Route::post('/inscription', 'store')->name('inscription.store');
        Route::get('/inscription/{id}', 'show')->name('inscription.show');
        Route::get('/inscription/{id}', 'edit')->name('inscription.edit');
        Route::post('/inscription/{id}', 'update')->name('inscription.update');
        Route::delete('/inscription/{id}', 'destroy')->name('inscription.destroy');
    });

});
