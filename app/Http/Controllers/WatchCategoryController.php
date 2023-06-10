<?php

namespace App\Http\Controllers;

use App\Models\WatchCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WatchCategoryController extends Controller
{
    public function list()
    {
        $watchCategories = WatchCategory::all();
        return response()->json([
            'message' => 'Watch Categories retrieved successfully',
            'categories' => $watchCategories
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $watchCategory = WatchCategory::create($request->all());
            return response()->json([
                'message' => 'Watch Category created successfully',
                'watchCategory' => $watchCategory
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Watch Category created failed',
                'error' => $th
            ], 400);
        }
    }

    public function show($watchId, $categoryId)
    {
        $watchCategory = WatchCategory::where('watch_id', $watchId)->where('category_id', $categoryId)->first();
        if (is_null($watchCategory)) {
            return response()->json(['message' => 'Watch Category not found'], 404);
        }
        return response()->json([
            'message' => 'Watch Category retrieved successfully',
            'watchCategory' => $watchCategory
        ], 200);
    }

    public function update(Request $request, $watchId, $categoryId)
    {
        try {
            $watchCategory = WatchCategory::where('watch_id', $watchId)->where('category_id', $categoryId)->first();
            if (is_null($watchCategory)) {
                return response()->json(['message' => 'Watch Category not found'], 404);
            }
            // $watchCategory->update($request->all());
            $watchCategory = DB::update('update watch_categories set watch_id = ?, category_id = ? where watch_id = ? and category_id = ?', [$request->watch_id, $request->category_id, $watchId, $categoryId]);
            if ($watchCategory) {
                $updatedRecords = DB::table('watch_categories')
                    ->where('watch_id', $request->watch_id)
                    ->where('category_id', $request->category_id)
                    ->get();
                return response()->json([
                    'message' => 'Watch Category updated successfully',
                    'watchCategory' => $updatedRecords
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Watch Category updated failed',
                    'watchCategory' => $watchCategory
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Watch Category updated failed',
                'error' => $th
            ], 400);
        }
    }

    public function destroy($watchId, $categoryId)
    {
        // Logic to delete a user by ID
        $watchCategory = WatchCategory::where('watch_id', $watchId)->where('category_id', $categoryId)->first();
        if (is_null($watchCategory)) {
            return response()->json(['message' => 'Watch Category not found'], 404);
        }
        DB::delete('delete from watch_categories where watch_id = ? and category_id = ?', [$watchId, $categoryId]);
        return response()->json(['message' => 'Watch Category was deleted'], 200);
    }
}
