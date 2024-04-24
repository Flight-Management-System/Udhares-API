<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PassengerController extends Controller
{
    public function index()
    {
        return Passenger::all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'passport_no' => 'required|string|unique:passengers',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        return Passenger::create($request->all());
    }

    public function show($id)
    {
        $passenger = Passenger::find($id);

        if ($passenger) {
            return $passenger;
        } else {

            $passenger = Passenger::query()->where('passport_no', $id)->first();
            if ($passenger) {
                return $passenger;
            }

            return response()->json(['message' => 'Passenger not found'], 404);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'passport_no' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $passenger = Passenger::find($id);
        $passengerPassport = Passenger::where('passport_no', $request->passport_no)->first();
        if ($passengerPassport && $passengerPassport->id != $id) {
            return response()->json(['message' => 'Passport number already exists'], 400);
        }
        $passenger->update($request->all());
        return $passenger;
    }

    public function destroy($id)
    {
        return Passenger::destroy($id);
    }

    public function search()
    {
        $query = request('q');

        return Passenger::query()
            ->where('first_name', 'like', "%$query%")
            ->orWhere('last_name', 'like', "%$query%")
            ->orWhere('passport_no', 'like', "%$query%")
            ->orderByRaw("CASE
                WHEN passport_no LIKE '$query%' THEN 1
                WHEN first_name LIKE '$query%' THEN 2
                WHEN last_name LIKE '$query%' THEN 3
                ELSE 4
            END")
            ->get();
    }
}
