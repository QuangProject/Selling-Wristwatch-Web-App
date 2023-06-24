<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function list()
    {
        $districts = District::all();
        return response()->json([
            'message' => 'Districts retrieved successfully',
            'districts' => $districts
        ], 200);
    }

    public function show($id)
    {
        $district = District::find($id);
        if (is_null($district)) {
            return response()->json(['message' => 'District not found'], 404);
        }
        return response()->json([
            'message' => 'District retrieved successfully',
            '$district' => $district
        ], 200);
    }

    public function listByProvince($province_id)
    {
        $districts = District::where('province_id', $province_id)->get();
        return response()->json([
            'message' => 'Districts retrieved successfully',
            'districts' => $districts
        ], 200);
    }
}
