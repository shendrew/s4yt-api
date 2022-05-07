<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('/location/countries', [\App\Http\Controllers\Api\LocationController::class, 'getCountries']);
    Route::get('/location/states', [\App\Http\Controllers\Api\LocationController::class, 'getStates']);
    Route::get('/location/cities', [\App\Http\Controllers\Api\LocationController::class, 'getCities']);
    Route::post('/logout', [AuthController::class, 'logout']);;
});
