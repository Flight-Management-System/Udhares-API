<?php

use App\Http\Controllers\AircraftController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FlightTripController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PassengerController;
use App\Models\Aircraft;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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
    Route::get('/search', [AircraftController::class, 'search']);
    Route::get('/{id}', [AircraftController::class, 'show']);
    Route::put('/{id}', [AircraftController::class, 'update']);
    Route::delete('/{id}', [AircraftController::class, 'destroy']);
});

Route::prefix('/passengers')->group(function() {
    Route::get('/', [PassengerController::class, 'index']);
    Route::post('/', [PassengerController::class, 'create']);
    Route::get('/search', [PassengerController::class, 'search']);
    Route::get('/{id}', [PassengerController::class, 'show']);
    Route::put('/{id}', [PassengerController::class, 'update']);
    Route::delete('/{id}', [PassengerController::class, 'destroy']);
});

Route::prefix('/groups')->group(function() {
    Route::get('/', [GroupController::class, 'index']);
    Route::post('/', [GroupController::class, 'create']);
    Route::get('/{id}', [GroupController::class, 'show']);
    Route::put('/{id}', [GroupController::class, 'update']);
    Route::delete('/{id}', [GroupController::class, 'destroy']);
});

Route::prefix('/bookings')->group(function() {
    Route::get('/', [BookingController::class, 'index']);
    Route::post('/', [BookingController::class, 'create']);
    Route::get('/{id}', [BookingController::class, 'show']);
    Route::put('/{id}', [BookingController::class, 'update']);
    Route::delete('/{id}', [BookingController::class, 'destroy']);
});

Route::prefix('/flight-trips')->group(function() {
    Route::get('/', [FlightTripController::class, 'index']);
    Route::post('/', [FlightTripController::class, 'create']);
    Route::get('/{id}', [FlightTripController::class, 'show']);
    Route::put('/{id}', [FlightTripController::class, 'update']);
    Route::delete('/{id}', [FlightTripController::class, 'destroy']);
});

Route::prefix('/flights')->group(function() {
    Route::get('/', [FlightController::class, 'index']);
    Route::post('/', [FlightController::class, 'create']);
    Route::get('/{id}', [FlightController::class, 'show']);
    Route::put('/{id}', [FlightController::class, 'update']);
    Route::delete('/{id}', [FlightController::class, 'destroy']);
});

Route::get('calculate-time', function() {
    $validator = Validator::make(request()->all(), [
        'from' => 'required|exists:locations,id',
        'to' => 'required|exists:locations,id',
        'aircraft' => 'required|exists:aircrafts,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()], 400);
    }

    $from = Location::find(request('from'));
    $to = Location::find(request('to'));
    $aircraft = Aircraft::find(request('aircraft'));

    $lat1 = deg2rad($from->lat);
    $lon1 = deg2rad($from->long);
    $lat2 = deg2rad($to->lat);
    $lon2 = deg2rad($to->long);

    $deltaLat = $lat2 - $lat1;
    $deltaLon = $lon2 - $lon1;

    $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
        cos($lat1) * cos($lat2) *
        sin($deltaLon / 2) * sin($deltaLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Radius of earth in Nautical Miles
    $radius = 3440;

    $distance = $radius * $c;

    $ktas = $aircraft->ktas;

    $time = $distance / $ktas;

    $hours = floor($time);
    $minutes = floor(($time - $hours) * 60);
    $seconds = round((($time - $hours) * 60 - $minutes) * 60);

    $time = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    return response()->json([
        'time' => $time,
    ]);
});
