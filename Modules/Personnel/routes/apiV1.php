<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Personnel\App\Http\Controllers\Api\V1\{ EnseignantController, AffectationController};

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
//     Route::get('personnel', fn (Request $request) => $request->user())->name('personnel');
// });

Route::group(['as' => 'shule::api.', 'prefix' => 'personnel'], function () {

    Route::controller(EnseignantController::class)->group(function () {
        Route::get('/enseignant', 'index')->name('enseignant.index');
        Route::post('/enseignant', 'store')->name('enseignant.store');
        Route::get('/enseignant/{id}', 'show')->name('enseignant.show');
        Route::get('/enseignant/{id}', 'edit')->name('enseignant.edit');
        Route::post('/enseignant/{id}', 'update')->name('enseignant.update');
        Route::delete('/enseignant/{id}', 'destroy')->name('enseignant.destroy');
    });

    Route::controller(AffectationController::class)->group(function () {
        Route::get('/affectation', 'index')->name('affectation.index');
        Route::post('/affectation', 'store')->name('affectation.store');
        Route::get('/affectation/{id}', 'show')->name('affectation.show');
        Route::get('/affectation/{id}', 'edit')->name('affectation.edit');
        Route::post('/affectation/{id}', 'update')->name('affectation.update');
        Route::delete('/affectation/{id}', 'destroy')->name('affectation.destroy');
    });
});
