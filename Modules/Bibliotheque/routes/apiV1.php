<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Bibliotheque\App\Http\Controllers\Api\V1\{ EmpruntController, LivreController, RemiseController };

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
//     Route::get('bibliotheque', fn (Request $request) => $request->user())->name('bibliotheque');
// });

Route::group(['as' => 'shule::api.', 'prefix' => 'bibliotheque'], function () {

    Route::controller(LivreController::class)->group(function () {
        Route::get('/livre', 'index')->name('livre.index');
        Route::post('/livre', 'store')->name('livre.store');
        Route::get('/livre/{id}', 'show')->name('livre.show');
        Route::get('/livre/{id}', 'edit')->name('livre.edit');
        Route::post('/livre/{id}', 'update')->name('livre.update');
        Route::delete('/livre/{id}', 'destroy')->name('livre.destroy');
    });

    Route::controller(EmpruntController::class)->group(function () {
        Route::get('/emprunt', 'index')->name('emprunt.index');
        Route::post('/emprunt', 'store')->name('emprunt.store');
        Route::get('/emprunt/{id}', 'show')->name('emprunt.show');
        Route::get('/emprunt/{id}', 'edit')->name('emprunt.edit');
        Route::post('/emprunt/{id}', 'update')->name('emprunt.update');
        Route::delete('/emprunt/{id}', 'destroy')->name('emprunt.destroy');
    });

    Route::controller(RemiseController::class)->group(function () {
        Route::get('/remise', 'index')->name('remise.index');
        Route::post('/remise', 'store')->name('remise.store');
        Route::get('/remise/{id}', 'show')->name('remise.show');
        Route::get('/remise/{id}', 'edit')->name('remise.edit');
        Route::post('/remise/{id}', 'update')->name('remise.update');
        Route::delete('/remise/{id}', 'destroy')->name('remise.destroy');
    });
});
