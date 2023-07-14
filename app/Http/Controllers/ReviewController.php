<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // public function index()
    // {
    //     $categories = Category::all();
    //     // return view('admin.brand.index');
    //     return view('admin.category.index')->with('categories', $categories);
    // }

    // public function list()
    // {
    //     $categories = Category::all();
    //     return response()->json([
    //         'message' => 'Categories retrieved successfully',
    //         'categories' => $categories
    //     ], 200);
    // }

    public function store(Request $request)
    {
        try {
            $user_id = $request->input('user_id');
            $watch_id = $request->input('watch_id');
            $rating = $request->input('rating');
            $comment = $request->input('comment');

            $review = new Review();
            $review->user_id = $user_id;
            $review->watch_id = $watch_id;
            $review->rating = $rating;
            $review->comment = $comment;
            $review->save();
            
            return response()->json([
                'message' => 'Review created successfully',
                'review' => $review
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Review created failed',
                'error' => $th
            ], 400);
        }
    }

    // public function show($id)
    // {
    //     $category = Category::find($id);
    //     if (is_null($category)) {
    //         return response()->json(['message' => 'Category not found'], 404);
    //     }
    //     return response()->json([
    //         'message' => 'Category retrieved successfully',
    //         'category' => $category
    //     ], 200);
    // }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $category = Category::find($id);
    //         if (is_null($category)) {
    //             return response()->json(['message' => 'Category not found'], 404);
    //         }
    //         // Check if name is exist
    //         $check = Category::where('name', $request->input('name'))->first();
    //         if ($check && $check->id != $id) {
    //             return response()->json(['message' => 'Category name already exist'], 400);
    //         }
    //         $category->update($request->all());
    //         return response()->json([
    //             'message' => 'Category updated successfully',
    //             'category' => $category
    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'message' => 'Category updated failed',
    //             'error' => $th
    //         ], 400);
    //     }
    // }

    // public function destroy($id)
    // {
    //     // Logic to delete a user by ID
    //     $category = Category::find($id);
    //     if (is_null($category)) {
    //         return response()->json(['message' => 'Category not found'], 404);
    //     }
    //     $category->delete();
    //     return response()->json(['message' => 'Category was deleted'], 200);
    // }
}
