<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function index()
    {
        return Group::all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_location' => 'required|exists:locations,id',
            'to_location' => 'required|exists:locations,id',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        return Group::create($request->all());
    }

    public function show($id)
    {
        $group = Group::find($id);

        if ($group) {
            return $group;
        } else {
            return response()->json(['message' => 'Group not found'], 404);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_location' => 'required|exists:locations,id',
            'to_location' => 'required|exists:locations,id',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $group = Group::find($id);
        $group->update($request->all());
        return $group;
    }

    public function destroy($id)
    {
        return Group::destroy($id);
    }
}
