<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AircraftController extends Controller
{
    public function index()
    {
        return Aircraft::all();
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reg_no' => 'unique:aircrafts|required|string',
            'seat_count' => 'required|integer',
            'dow' => 'required|integer',
            'mtow' => 'required|integer',
            'ktas' => 'required|integer',
            'fuel_capacity' => 'required|integer',
            'is_active' => 'required|boolean',
            'last_compwash' => 'nullable|date',
            'cg_index' => 'required|numeric',
            'current_location' => 'required|integer|exists:locations,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $request['last_compwash'] = $request->last_compwash ? date('Y-m-d H:i:s', strtotime($request->last_compwash)) : null;

        return Aircraft::create($request->all());
    }

    public function show($id)
    {
        $aircraft = Aircraft::find($id);

        if ($aircraft) {
            return $aircraft;
        } else {

            $aircraft = Aircraft::query()->where('reg_no', $id)->first();
            if ($aircraft) {
                return $aircraft;
            }

            return response()->json(['message' => 'Aircraft not found'], 404);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reg_no' => 'required|string',
            'seat_count' => 'required|integer',
            'dow' => 'required|integer',
            'mtow' => 'required|integer',
            'ktas' => 'required|integer',
            'fuel_capacity' => 'required|integer',
            'is_active' => 'required|boolean',
            'last_compwash' => 'nullable|date',
            'cg_index' => 'required|numeric',
            'current_location' => 'required|integer|exists:locations,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $request['last_compwash'] = $request->last_compwash ? date('Y-m-d H:i:s', strtotime($request->last_compwash)) : null;

        $aircraft = Aircraft::find($id);
        $aircaftReg = Aircraft::where('reg_no', $request->reg_no)->first();
        if ($aircaftReg && ($aircaftReg->id != $id)) {
            return response()->json(['message' => 'An aircraft with this reg number already exists: ' . $request->reg_no], 400);
        }
        $aircraft->update($request->all());
        return $aircraft;
    }

    public function destroy($id)
    {
        return Aircraft::destroy($id);
    }

    public function search()
    {
        $query = request('q');

        return Aircraft::query()->where('reg_no', 'like', "%$query%")->get();
    }
}
