<?php

namespace App\Http\Controllers;

use App\Models\Watch;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    public function index()
    {
        $watches = Watch::join('collections', 'watches.collection_id', '=', 'collections.id')
            ->select('watches.id', 'watches.model', 'watches.original_price', 'watches.selling_price', 'watches.discount', 'watches.stock', 'watches.gender', 'watches.case_material', 'watches.case_diameter', 'watches.case_thickness', 'watches.strap_material', 'watches.dial_color', 'watches.crystal_material', 'watches.water_resistance', 'watches.movement_type', 'watches.power_reserve', 'watches.complications', 'watches.availability', 'collections.id as collection_id', 'collections.name as collection_name')
            ->get();
        return view('admin.watch.index')->with('watches', $watches);
    }

    public function list()
    {
        // $watches = Watch::all();
        $watches = Watch::join('collections', 'watches.collection_id', '=', 'collections.id')
            ->select('watches.id', 'watches.model', 'watches.original_price', 'watches.selling_price', 'watches.discount', 'watches.stock', 'watches.gender', 'watches.case_material', 'watches.case_diameter', 'watches.case_thickness', 'watches.strap_material', 'watches.dial_color', 'watches.crystal_material', 'watches.water_resistance', 'watches.movement_type', 'watches.power_reserve', 'watches.complications', 'watches.availability', 'collections.id as collection_id', 'collections.name as collection_name')
            ->get();
        return response()->json([
            'message' => 'Watches retrieved successfully',
            'watches' => $watches
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            // Check if name is exist
            $check = Watch::where('model', $request->input('model'))->first();
            if ($check) {
                return response()->json(['message' => 'Watch model already exist'], 400);
            }
            $watch = Watch::create($request->all());
            // display watch
            $display = Watch::join('collections', 'watches.collection_id', '=', 'collections.id')
                ->select('watches.id', 'watches.model', 'watches.original_price', 'watches.selling_price', 'watches.discount', 'watches.stock', 'watches.gender', 'watches.case_material', 'watches.case_diameter', 'watches.case_thickness', 'watches.strap_material', 'watches.dial_color', 'watches.crystal_material', 'watches.water_resistance', 'watches.movement_type', 'watches.power_reserve', 'watches.complications', 'watches.availability', 'collections.id as collection_id', 'collections.name as collection_name')
                ->where('watches.id', $watch->id)
                ->first();
            return response()->json([
                'message' => 'Watch created successfully',
                'watch' => $display
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Watch created failed',
                'error' => $th
            ], 400);
        }
    }

    public function show($id)
    {
        $watch = Watch::find($id);
        if (is_null($watch)) {
            return response()->json(['message' => 'Watch not found'], 404);
        }
        return response()->json([
            'message' => 'Watch retrieved successfully',
            'watch' => $watch
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $watch = Watch::find($id);
            if (is_null($watch)) {
                return response()->json(['message' => 'Watch not found'], 404);
            }
            // Check if name is exist
            $check = Watch::where('model', $request->input('model'))->first();
            if ($check && $check->id != $id) {
                return response()->json(['message' => 'Watch model already exist'], 400);
            }
            $watch->update($request->all());
            // display watch
            $display = Watch::join('collections', 'watches.collection_id', '=', 'collections.id')
                ->select('watches.id', 'watches.model', 'watches.original_price', 'watches.selling_price', 'watches.discount', 'watches.stock', 'watches.gender', 'watches.case_material', 'watches.case_diameter', 'watches.case_thickness', 'watches.strap_material', 'watches.dial_color', 'watches.crystal_material', 'watches.water_resistance', 'watches.movement_type', 'watches.power_reserve', 'watches.complications', 'watches.availability', 'collections.id as collection_id', 'collections.name as collection_name')
                ->where('watches.id', $watch->id)
                ->first();
            return response()->json([
                'message' => 'Watch updated successfully',
                'watch' => $display
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Watch updated failed',
                'error' => $th
            ], 400);
        }
    }

    public function destroy($id)
    {
        // Logic to delete a user by ID
        $watch = Watch::find($id);
        if (is_null($watch)) {
            return response()->json(['message' => 'Watch not found'], 404);
        }
        $watch->delete();
        return response()->json(['message' => 'Watch was deleted'], 200);
    }
}
