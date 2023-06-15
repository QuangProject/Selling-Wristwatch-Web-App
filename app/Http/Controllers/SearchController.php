<?php

namespace App\Http\Controllers;

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
}
