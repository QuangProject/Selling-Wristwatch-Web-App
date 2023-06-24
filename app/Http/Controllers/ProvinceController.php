<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function list()
    {
        $provinces = Province::all();
        return response()->json([
            'message' => 'Provinces retrieved successfully',
            'provinces' => $provinces
        ], 200);
    }

    public function show($id)
    {
        $province = Province::find($id);
        if (is_null($province)) {
            return response()->json(['message' => 'Province not found'], 404);
        }
        return response()->json([
            'message' => 'Province retrieved successfully',
            '$province' => $province
        ], 200);
    }
}
