<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Watch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Action suggestions()
    public function suggestions(Request $request)
    {
        $keyword = $request->get('query');
        // Search Watch
        $watches = Watch::where('model', 'like', '%' . $keyword . '%')->get();
        $modelWatchs = [];
        foreach ($watches as $watch) {
            $modelWatchs[] = $watch->model;
        }
        $results = array_filter($modelWatchs, function ($modelWatch) use ($keyword) {
            return strpos(strtolower($modelWatch), strtolower($keyword)) !== false;
        });
        return response()->json($results);
    }

    // Action watchSuggestions()
    public function watchSuggestions(Request $request)
    {
        $keyword = $request->get('query');
        // Search Watch
        $watches = Watch::where('model', 'like', '%' . $keyword . '%')->get();
        $modelWatchs = [];
        foreach ($watches as $watch) {
            $modelWatchs[] = $watch->model;
        }
        $results = array_filter($modelWatchs, function ($modelWatch) use ($keyword) {
            return strpos(strtolower($modelWatch), strtolower($keyword)) !== false;
        });
        return response()->json($results);
    }

    // Action categorySuggestions()
    public function categorySuggestions(Request $request)
    {
        $keyword = $request->get('query');
        // Search Watch
        $categories = Category::where('name', 'like', '%' . $keyword . '%')->get();
        $modelCategories = [];
        foreach ($categories as $category) {
            $modelCategories[] = $category->name;
        }
        $results = array_filter($modelCategories, function ($modelCategory) use ($keyword) {
            return strpos(strtolower($modelCategory), strtolower($keyword)) !== false;
        });
        return response()->json($results);
    }
}
