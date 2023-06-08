<?php

namespace App\Http\Controllers;

use App\Models\Watch;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    public function index()
    {
        $watches = Watch::all();
        return response()->json([
            'message' => 'Watches retrieved successfully',
            'watches' => $watches
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $watch = Watch::create($request->all());
            return response()->json([
                'message' => 'Watch created successfully',
                'watch' => $watch
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
            $watch->update($request->all());
            return response()->json([
                'message' => 'Watch updated successfully',
                'watch' => $watch
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
