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

// Location services
Route::get('/location/countries', [\App\Http\Controllers\Api\RegisterController::class, 'getCountries']);
Route::get('/location/states', [\App\Http\Controllers\Api\RegisterController::class, 'getStates'])->name('location.states');
Route::get('/location/cities', [\App\Http\Controllers\Api\RegisterController::class, 'getCities'])->name('location.cities');
Route::get('/educations', [\App\Http\Controllers\Api\RegisterController::class, 'getEducations'])->name('education.index');
Route::get('/grades', [\App\Http\Controllers\Api\RegisterController::class, 'getGrades'])->name('grades.index');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);;
});
