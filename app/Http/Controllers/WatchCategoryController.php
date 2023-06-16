<?php

namespace App\Http\Controllers;

use App\Models\WatchCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WatchCategoryController extends Controller
{
    public function index()
    {
        $watchCategories = WatchCategory::join('watches', 'watch_categories.watch_id', '=', 'watches.id')
            ->join('categories', 'watch_categories.category_id', '=', 'categories.id')
            ->select('watch_categories.*', 'watches.model as watch_model', 'categories.name as category_name')
            ->get();
        // return view('admin.brand.index');
        return view('admin.watch_category.index')->with('watchCategories', $watchCategories);
    }

    public function list()
    {
        $watchCategories = WatchCategory::join('watches', 'watch_categories.watch_id', '=', 'watches.id')
            ->join('categories', 'watch_categories.category_id', '=', 'categories.id')
            ->select('watch_categories.*', 'watches.model as watch_model', 'categories.name as category_name')
            ->get();
        return response()->json([
            'message' => 'Watch Categories retrieved successfully',
            'categories' => $watchCategories
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            // Check if watch category is exist
            $check = WatchCategory::where('watch_id', $request->input('watch_id'))->where('category_id', $request->input('category_id'))->first();
            if ($check) {
                return response()->json(['message' => 'Watch Category already exist'], 400);
            }
            $watchCategory = WatchCategory::create($request->all());
            // display watch category
            $watchCategory = WatchCategory::join('watches', 'watch_categories.watch_id', '=', 'watches.id')
                ->join('categories', 'watch_categories.category_id', '=', 'categories.id')
                ->select('watch_categories.*', 'watches.model as watch_model', 'categories.name as category_name')
                ->where('watch_categories.watch_id', $watchCategory->watch_id)
                ->where('watch_categories.category_id', $watchCategory->category_id)
                ->first();
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
            // Check if watch category is exist
            $check = WatchCategory::where('watch_id', $request->input('watch_id'))->where('category_id', $request->input('category_id'))->first();
            if ($check) {
                return response()->json(['message' => 'Watch Category already exist'], 400);
            }
            // $watchCategory->update($request->all());
            $watchCategory = DB::update('update watch_categories set watch_id = ?, category_id = ? where watch_id = ? and category_id = ?', [$request->watch_id, $request->category_id, $watchId, $categoryId]);
            if ($watchCategory) {
                $watchCategory = WatchCategory::join('watches', 'watch_categories.watch_id', '=', 'watches.id')
                    ->join('categories', 'watch_categories.category_id', '=', 'categories.id')
                    ->select('watch_categories.*', 'watches.model as watch_model', 'categories.name as category_name')
                    ->where('watch_categories.watch_id', $request->watch_id)
                    ->where('watch_categories.category_id', $request->category_id)
                    ->first();
                return response()->json([
                    'message' => 'Watch Category updated successfully',
                    'watchCategory' => $watchCategory
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Watch Category updated failed',
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
