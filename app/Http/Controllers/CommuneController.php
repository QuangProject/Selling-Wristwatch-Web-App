<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    public function list()
    {
        $communes = Commune::all();
        return response()->json([
            'message' => 'Communes retrieved successfully',
            'communes' => $communes
        ], 200);
    }

    public function show($id)
    {
        $commune = Commune::find($id);
        if (is_null($commune)) {
            return response()->json(['message' => 'Commune not found'], 404);
        }
        return response()->json([
            'message' => 'Commune retrieved successfully',
            '$commune' => $commune
        ], 200);
    }

    public function listByDistrict($district_id)
    {
        $communes = Commune::where('district_id', $district_id)->get();
        return response()->json([
            'message' => 'Communes retrieved successfully',
            'communes' => $communes
        ], 200);
    }
}
