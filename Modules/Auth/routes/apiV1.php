<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\Api\V1\{ LoginController, ResetController, RegisterController, PermissionController, RoleController };

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
//     Route::get('auth', fn (Request $request) => $request->user())->name('auth');
// });

Route::group(['as' => 'schoolmanager::api.', 'prefix' => 'auth'], function () {

    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::controller(RegisterController::class)->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/verify', 'verify')->name('verify');
        Route::get('resend-code/{user}', 'resendCode')->name('resend.code');

        Route::post('/users/{user}/roles', 'assignRole')->name('users.roles');
        Route::delete('/users/{user}/roles/{role}', 'removeRole')->name('users.roles.remove');
        Route::post('/users/{user}/permissions', 'givePermission')->name('users.permissions');
        Route::delete('/users/{user}/permissions/{permission}', 'revokePermission')->name('users.permissions.remove');

    });

    Route::controller(RoleController::class)->group(function () {
        Route::post('/roles/{role}/permissions','givePermission')->name('roles.permissions');
        Route::delete('/roles/{role}/permissions/{permission}','revokePermission')->name('roles.permissions');
    });

    Route::controller(PermissionController::class)->group(function () {
        Route::post('/permissions/{permission}/roles','assignRole')->name('permissions.roles');
        Route::delete('/permissions/{permission}/roles/{role}', 'removeRole')->name('.permissions.roles');
    });
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);

    Route::controller(ResetController::class)->group(function () {
        Route::post('/request-reset', 'requestReset')->name('request.reset');
        Route::post('/reset', 'reset')->name('reset');
    });
    // protected toutes
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::group([
            'as' => 'user.',
            'prefix' => 'user',
        ], function () {
            Route::get('me', 'AuthController@me')->name('me');
            Route::get('notifications', 'AuthController@notifications')->name('notifications');
        });
    });
});
