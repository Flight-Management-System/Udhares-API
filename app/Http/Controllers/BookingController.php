<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'passenger' => 'required|exists:passengers,id',
            'pnr' => 'required|string|unique:bookings',
            'flight' => 'nullable|exists:flights,id',
            'flight_trip' => 'nullable|exists:flight_trips,id',
            'group' => 'nullable|exists:groups,id',
            'dept_location' => 'required|exists:locations,id',
            'arr_location' => 'required|exists:locations,id',
            'allowed_weight' => 'required|numeric',
            'is_active' => 'required|boolean',
            'is_going_abroad' => 'required|boolean',
            'is_coming_from_abroad' => 'required|boolean',
            'international_flight_no' => 'required|string',
            'scheduled_dept_datetime' => 'nullable|date',
            'scheduled_arr_datetime' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $request['scheduled_dept_datetime'] = $request->scheduled_dept_datetime ? date('Y-m-d H:i:s', strtotime($request->scheduled_dept_datetime)) : null;
        $request['scheduled_arr_datetime'] = $request->scheduled_arr_datetime ? date('Y-m-d H:i:s', strtotime($request->scheduled_arr_datetime)) : null;

        return Booking::create($request->all());
    }

    public function show($id)
    {
        $booking = Booking::find($id);

        if ($booking) {
            return $booking;
        } else {
            return response()->json(['message' => 'Booking not found'], 404);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'passenger' => 'required|exists:passengers,id',
            'pnr' => 'required|string',
            'flight' => 'nullable|exists:flights,id',
            'flight_trip' => 'nullable|exists:flight_trips,id',
            'group' => 'nullable|exists:groups,id',
            'dept_location' => 'required|exists:locations,id',
            'arr_location' => 'required|exists:locations,id',
            'allowed_weight' => 'required|numeric',
            'is_active' => 'required|boolean',
            'is_going_abroad' => 'required|boolean',
            'is_coming_from_abroad' => 'required|boolean',
            'international_flight_no' => 'nullable|string',
            'scheduled_dept_datetime' => 'nullable|date',
            'scheduled_arr_datetime' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $booking = Booking::find($id);

        $bookingPnr = Booking::where('pnr', $request->pnr)->first();
        if ($bookingPnr && $bookingPnr->id != $id) {
            return response()->json(['message' => 'PNR already exists'], 400);
        }

        $request['scheduled_dept_datetime'] = $request->scheduled_dept_datetime ? date('Y-m-d H:i:s', strtotime($request->scheduled_dept_datetime)) : null;
        $request['scheduled_arr_datetime'] = $request->scheduled_arr_datetime ? date('Y-m-d H:i:s', strtotime($request->scheduled_arr_datetime)) : null;

        $booking->update($request->all());
        return $booking;
    }

    public function destroy($id)
    {
        return Booking::destroy($id);
    }
}
