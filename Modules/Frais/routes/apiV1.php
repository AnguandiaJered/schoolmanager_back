<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Frais\App\Http\Controllers\Api\V1\{ FraisController, PaiementController, PrevisionController};

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
//     Route::get('frais', fn (Request $request) => $request->user())->name('frais');
// });

Route::group(['as' => 'shule::api.', 'prefix' => 'frais'], function () {

    Route::controller(FraisController::class)->group(function () {
        Route::get('/frais', 'index')->name('frais.index');
        Route::post('/frais', 'store')->name('frais.store');
        Route::get('/frais/{id}', 'show')->name('frais.show');
        Route::get('/frais/{id}', 'edit')->name('frais.edit');
        Route::post('/frais/{id}', 'update')->name('frais.update');
        Route::delete('/frais/{id}', 'destroy')->name('frais.destroy');
    });

    Route::controller(PaiementController::class)->group(function () {
        Route::get('/paiement', 'index')->name('paiement.index');
        Route::post('/paiement', 'store')->name('paiement.store');
        Route::get('/paiement/{id}', 'show')->name('paiement.show');
        Route::get('/paiement/{id}', 'edit')->name('paiement.edit');
        Route::post('/paiement/{id}', 'update')->name('paiement.update');
        Route::delete('/paiement/{id}', 'destroy')->name('paiement.destroy');
    });

    Route::controller(PrevisionController::class)->group(function () {
        Route::get('/prevision', 'index')->name('prevision.index');
        Route::post('/prevision', 'store')->name('prevision.store');
        Route::get('/prevision/{id}', 'show')->name('prevision.show');
        Route::get('/prevision/{id}', 'edit')->name('prevision.edit');
        Route::post('/prevision/{id}', 'update')->name('prevision.update');
        Route::delete('/prevision/{id}', 'destroy')->name('prevision.destroy');
    });

});
