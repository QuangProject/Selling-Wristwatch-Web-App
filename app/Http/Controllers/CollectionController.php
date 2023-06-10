<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function list()
    {
        $collections = Collection::all();
        return response()->json([
            'message' => 'Collections retrieved successfully',
            'collections' => $collections
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $collection = Collection::create($request->all());
            return response()->json([
                'message' => 'Collection created successfully',
                'collection' => $collection
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Collection created failed',
                'error' => $th
            ], 400);
        }
    }

    public function show($id)
    {
        $collection = Collection::find($id);
        if (is_null($collection)) {
            return response()->json(['message' => 'Collection not found'], 404);
        }
        return response()->json([
            'message' => 'Collection retrieved successfully',
            'collection' => $collection
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $collection = Collection::find($id);
            if (is_null($collection)) {
                return response()->json(['message' => 'Collection not found'], 404);
            }
            $collection->update($request->all());
            return response()->json([
                'message' => 'Collection updated successfully',
                'collection' => $collection
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Collection updated failed',
                'error' => $th
            ], 400);
        }
    }

    public function destroy($id)
    {
        // Logic to delete a user by ID
        $collection = Collection::find($id);
        if (is_null($collection)) {
            return response()->json(['message' => 'Collection not found'], 404);
        }
        $collection->delete();
        return response()->json(['message' => 'Collection was deleted'], 200);
    }
}
