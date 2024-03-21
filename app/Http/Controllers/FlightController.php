<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    public function index()
    {
        return Flight::all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'flight_trip' => 'required|integer|exists:flight_trips,id',
            'flight_no' => 'required|string|unique:flights',
            'dept_time' => 'required|date',
            'arr_time' => 'required|date',
            'dept_location' => 'required|integer|exists:locations,id',
            'arr_location' => 'required|integer|exists:locations,id',
            'required_fuel' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        if ($request->dept_location == $request->arr_location) {
            return response()->json(['message' => 'Departure and arrival locations cannot be the same'], 400);
        }

        $request['dept_time'] = date('Y-m-d H:i:s', strtotime($request->dept_time));
        $request['arr_time'] = date('Y-m-d H:i:s', strtotime($request->arr_time));

        if ($request->dept_time >= $request->arr_time) {
            return response()->json(['message' => 'Departure time cannot be greater than or equal to arrival time'], 400);
        }

        return Flight::create($request->all());
    }

    public function show($id)
    {
        $flight = Flight::find($id);

        if ($flight) {
            return $flight;
        } else {
            return response()->json(['message' => 'Flight not found'], 404);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'flight_trip' => 'required|integer|exists:flight_trips,id',
            'flight_no' => 'required|string',
            'dept_time' => 'required|date',
            'arr_time' => 'required|date',
            'dept_location' => 'required|integer|exists:locations,id',
            'arr_location' => 'required|integer|exists:locations,id',
            'required_fuel' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        if ($request->dept_location == $request->arr_location) {
            return response()->json(['message' => 'Departure and arrival locations cannot be the same'], 400);
        }

        $request['dept_time'] = date('Y-m-d H:i:s', strtotime($request->dept_time));
        $request['arr_time'] = date('Y-m-d H:i:s', strtotime($request->arr_time));

        if ($request->dept_time >= $request->arr_time) {
            return response()->json(['message' => 'Departure time cannot be greater than or equal to arrival time'], 400);
        }

        $flight = Flight::find($id);
        $flightNo = Flight::where('flight_no', $request->flight_no)->first();
        if ($flightNo && $flightNo->id != $id) {
            return response()->json(['message' => 'Flight number already exists'], 400);
        }
        $flight->update($request->all());
        return $flight;
    }

    public function destroy($id)
    {
        return Flight::destroy($id);
    }
}
