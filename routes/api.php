<?php

use App\Http\Controllers\AircraftController;
use App\Http\Controllers\LocationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/locations')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::post('/', [LocationController::class, 'create']);
    Route::get('/{id}', [LocationController::class, 'show']);
    Route::put('/{id}', [LocationController::class, 'update']);
    Route::delete('/{id}', [LocationController::class, 'destroy']);
});

Route::prefix('/aircrafts')->group(function () {
    Route::get('/', [AircraftController::class, 'index']);
    Route::post('/', [AircraftController::class, 'create']);
    Route::get('/{id}', [AircraftController::class, 'show']);
    Route::put('/{id}', [AircraftController::class, 'update']);
    Route::delete('/{id}', [AircraftController::class, 'destroy']);
});
