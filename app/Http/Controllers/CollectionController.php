<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::join('brands', 'collections.brand_id', '=', 'brands.id')
            ->select('collections.id', 'collections.name', 'collections.release_date', 'brands.name as brand_name')
            ->get();

        return view('admin.collection.index')->with('collections', $collections);
    }

    public function list()
    {
        $collections = Collection::join('brands', 'collections.brand_id', '=', 'brands.id')
            ->select('collections.id', 'collections.name', 'collections.release_date', 'brands.name as brand_name')
            ->get();

        return response()->json([
            'message' => 'Collections retrieved successfully',
            'collections' => $collections
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            // Check if name is exist
            $check = Collection::where('name', $request->input('name'))->first();
            if ($check) {
                return response()->json(['message' => 'Collection name already exist'], 400);
            }
            $collection = Collection::create($request->all());
            // display collection
            $display = Collection::join('brands', 'collections.brand_id', '=', 'brands.id')
                ->select('collections.id', 'collections.name', 'collections.release_date', 'brands.name as brand_name')
                ->where('collections.id', $collection->id)
                ->first();

            return response()->json([
                'message' => 'Collection created successfully',
                'collection' => $display
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
            // Check if name is exist
            $check = Collection::where('name', $request->input('name'))->first();
            if ($check && $check->id != $id) {
                return response()->json(['message' => 'Collection name already exist'], 400);
            }
            $collection->update($request->all());
            // display collection
            $display = Collection::join('brands', 'collections.brand_id', '=', 'brands.id')
                ->select('collections.id', 'collections.name', 'collections.release_date', 'brands.name as brand_name')
                ->where('collections.id', $collection->id)
                ->first();
            return response()->json([
                'message' => 'Collection updated successfully',
                'collection' => $display
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
