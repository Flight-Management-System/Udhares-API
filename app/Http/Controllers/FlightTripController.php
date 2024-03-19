<?php

namespace App\Http\Controllers;

use App\Models\FlightTrip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlightTripController extends Controller
{
    public function index()
    {
        return FlightTrip::all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aircraft' => 'required|integer|exists:aircrafts,id',
            'start_location' => 'required|integer|exists:locations,id',
            'end_location' => 'required|integer|exists:locations,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        if ($request->start_location == $request->end_location) {
            return response()->json(['message' => 'Start and end locations cannot be the same'], 400);
        }

        return FlightTrip::create($request->all());
    }

    public function show($id)
    {
        $flightTrip = FlightTrip::find($id);

        if ($flightTrip) {
            return $flightTrip;
        } else {
            return response()->json(['message' => 'Flight trip not found'], 404);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aircraft' => 'required|integer|exists:aircrafts,id',
            'start_location' => 'required|integer|exists:locations,id',
            'end_location' => 'required|integer|exists:locations,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        if ($request->start_location == $request->end_location) {
            return response()->json(['message' => 'Start and end locations cannot be the same'], 400);
        }

        $flightTrip = FlightTrip::find($id);
        $flightTrip->update($request->all());
        return $flightTrip;
    }

    public function destroy($id)
    {
        return FlightTrip::destroy($id);
    }
}
