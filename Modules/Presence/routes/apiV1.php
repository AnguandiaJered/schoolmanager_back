<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Presence\App\Http\Controllers\Api\V1\PresenceController;

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
//     Route::get('presence', fn (Request $request) => $request->user())->name('presence');
// });

Route::group(['as' => 'shule::api.', 'prefix' => 'presence'], function () {

    Route::controller(PresenceController::class)->group(function () {
        Route::get('/presence', 'index')->name('presence.index');
        Route::post('/presence', 'store')->name('presence.store');
        Route::get('/presence/{id}', 'show')->name('presence.show');
        Route::get('/presence/{id}', 'edit')->name('presence.edit');
        Route::post('/presence/{id}', 'update')->name('presence.update');
        Route::delete('/presence/{id}', 'destroy')->name('presence.destroy');
    });

});
