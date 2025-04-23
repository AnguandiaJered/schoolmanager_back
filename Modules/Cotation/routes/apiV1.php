<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Cotation\App\Http\Controllers\Api\V1\{ CoursController, PeriodeController, CoteController, DisciplineController, MensionController };

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
//     Route::get('cotation', fn (Request $request) => $request->user())->name('cotation');
// });


Route::group(['as' => 'shule::api.', 'prefix' => 'cotation'], function () {

    Route::controller(CoursController::class)->group(function () {
        Route::get('/cours', 'index')->name('cours.index');
        Route::post('/cours', 'store')->name('cours.store');
        Route::get('/cours/{id}', 'show')->name('cours.show');
        Route::get('/cours/{id}', 'edit')->name('cours.edit');
        Route::post('/cours/{id}', 'update')->name('cours.update');
        Route::delete('/cours/{id}', 'destroy')->name('cours.destroy');
    });

    Route::controller(PeriodeController::class)->group(function () {
        Route::get('/periode', 'index')->name('periode.index');
        Route::post('/periode', 'store')->name('periode.store');
        Route::get('/periode/{id}', 'show')->name('periode.show');
        Route::get('/periode/{id}', 'edit')->name('periode.edit');
        Route::post('/periode/{id}', 'update')->name('periode.update');
        Route::delete('/periode/{id}', 'destroy')->name('periode.destroy');
    });

    Route::controller(CoteController::class)->group(function () {
        Route::get('/cote', 'index')->name('cote.index');
        Route::post('/cote', 'store')->name('cote.store');
        Route::get('/cote/{id}', 'show')->name('cote.show');
        Route::get('/cote/{id}', 'edit')->name('cote.edit');
        Route::post('/remise/{id}', 'update')->name('cote.update');
        Route::delete('/cote/{id}', 'destroy')->name('cote.destroy');
    });

    Route::controller(DisciplineController::class)->group(function () {
        Route::get('/discipline', 'index')->name('discipline.index');
        Route::post('/discipline', 'store')->name('discipline.store');
        Route::get('/discipline/{id}', 'show')->name('discipline.show');
        Route::get('/discipline/{id}', 'edit')->name('discipline.edit');
        Route::post('/discipline/{id}', 'update')->name('discipline.update');
        Route::delete('/discipline/{id}', 'destroy')->name('discipline.destroy');
    });

    Route::controller(MensionController::class)->group(function () {
        Route::get('/mention', 'index')->name('mention.index');
        Route::post('/mention', 'store')->name('mention.store');
        Route::get('/mention/{id}', 'show')->name('mention.show');
        Route::get('/mention/{id}', 'edit')->name('mention.edit');
        Route::post('/mention/{id}', 'update')->name('mention.update');
        Route::delete('/mention/{id}', 'destroy')->name('mention.destroy');
    });

});
