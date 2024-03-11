<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'shortcode' => 'unique:locations|required|string|size:3|regex:/^[A-Z]*$/',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            'platform_count' => 'required|integer',
            'is_fuelable' => 'required|boolean',
            'is_maintenance_base' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        return Location::create($request->all());
    }

    public function show($id)
    {
        $location = Location::find($id);

        if ($location) {
            return $location;
        } else {
            return response()->json(['message' => 'Location not found'], 404);
        }
    }

    public function update($id, Request $request)
    {
        // Shortcode should be unique, but it should not be unique for the same location
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'shortcode' => 'required|string|size:3|regex:/^[A-Z]*$/',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            'platform_count' => 'required|integer',
            'is_fuelable' => 'required|boolean',
            'is_maintenance_base' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $location = Location::find($id);
        $shortcodeLocation = Location::where('shortcode', $request->shortcode)->first();
        if ($shortcodeLocation && ($shortcodeLocation->id != $id)) {
            return response()->json(['message' => 'Shortcode already exists'], 400);
        }
        $location->update($request->all());
        return $location;
    }

    public function destroy($id)
    {
        return Location::destroy($id);
    }
}
