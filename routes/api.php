<?php

use Illuminate\Http\Request;
use Laravel\Passport\Passport;


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

Passport::Routes();

Route::middleware('auth:api')->group(function() {
    Route::resource('users', UserController::class);
});

Route::middleware('auth:api')->get('/auth/user', function () {
    return request()->user();
});
