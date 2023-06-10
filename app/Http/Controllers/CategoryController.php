<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::all();
        return response()->json([
            'message' => 'Categories retrieved successfully',
            'categories' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $category = Category::create($request->all());
            return response()->json([
                'message' => 'Category created successfully',
                'category' => $category
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Category created failed',
                'error' => $th
            ], 400);
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json([
            'message' => 'Category retrieved successfully',
            'category' => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);
            if (is_null($category)) {
                return response()->json(['message' => 'Category not found'], 404);
            }
            $category->update($request->all());
            return response()->json([
                'message' => 'Category updated successfully',
                'category' => $category
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Category updated failed',
                'error' => $th
            ], 400);
        }
    }

    public function destroy($id)
    {
        // Logic to delete a user by ID
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Category was deleted'], 200);
    }
}
