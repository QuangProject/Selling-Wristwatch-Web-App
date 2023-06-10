<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        // return view('admin.brand.index');
        return view('admin.brand.index', compact('brands'));
    }

    public function list()
    {
        $brands = Brand::all();
        return response()->json([
            'message' => 'Brands retrieved successfully',
            'brands' => $brands
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $imagePath = $request->file('image')->store('public/brands');

            $brand = new Brand();
            $brand->name = $request->input('name');
            $brand->country_of_origin = $request->input('country_of_origin');
            $brand->year_established = $request->input('year_established');
            $brand->image = $imagePath;
            $brand->save();

            return response()->json([
                'message' => 'Brand created successfully',
                'brand' => $brand
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Brand created failed',
                'error' => $th
            ], 400);
        }
    }

    public function getImage($id)
    {
        $brand = Brand::find($id);
        if (is_null($brand)) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $filePath = $brand->image;
        $imagePath = Storage::disk('')->path($filePath);
        $headers = ['Content-Type' => mime_content_type($imagePath)];

        return new StreamedResponse(function () use ($imagePath) {
            readfile($imagePath);
        }, 200, $headers);
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        if (is_null($brand)) {
            return response()->json(['message' => 'Brand not found'], 404);
        }
        return response()->json([
            'message' => 'Brand retrieved successfully',
            'brand' => $brand
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $brand = Brand::find($id);
            if (is_null($brand)) {
                return response()->json(['message' => 'Brand not found'], 404);
            }
            if ($request->hasFile('image')) {
                // Delete the existing image from storage
                Storage::disk('')->delete($brand->image);

                // Store the new image
                $imagePath = $request->file('image')->store('public/brands');

                $brand->name = $request->input('name');
                $brand->country_of_origin = $request->input('country_of_origin');
                $brand->year_established = $request->input('year_established');
                $brand->image = $imagePath;
            } else {
                $brand->name = $request->input('name');
                $brand->country_of_origin = $request->input('country_of_origin');
                $brand->year_established = $request->input('year_established');
            }
            $brand->save();
            return response()->json([
                'message' => 'Brand updated successfully',
                'brand' => $brand
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Brand updated failed',
                'error' => $th
            ], 400);
        }
    }

    public function destroy($id)
    {
        // Logic to delete a user by ID
        $brand = Brand::find($id);
        if (is_null($brand)) {
            return response()->json(['message' => 'Brand not found'], 404);
        }
        // Delete the existing image from storage
        Storage::disk('')->delete($brand->image);

        $brand->delete();
        return response()->json(['message' => 'Brand was deleted'], 200);
    }
}
