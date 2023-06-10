<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImageController extends Controller
{
    public function list($watchId)
    {
        $images = Image::where('watch_id', $watchId)->get();
        return response()->json([
            'message' => 'Images retrieved successfully',
            'images' => $images
        ], 200);
    }

    public function store(Request $request, $watchId)
    {
        try {
            $imagePath = $request->file('image')->store('public/images');

            $image = new Image();
            $image->image_url = $imagePath;
            $image->watch_id = $watchId;
            $image->save();

            return response()->json([
                'message' => 'Image created successfully',
                'image' => $image
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Image created failed',
                'error' => $th
            ], 400);
        }
    }

    public function getImage($id)
    {
        $image = Image::find($id);
        if (is_null($image)) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $filePath = $image->image_url;
        $imagePath = Storage::disk('')->path($filePath);
        $headers = ['Content-Type' => mime_content_type($imagePath)];

        return new StreamedResponse(function () use ($imagePath) {
            readfile($imagePath);
        }, 200, $headers);
    }

    public function show($id)
    {
        $image = Image::find($id);
        if (is_null($image)) {
            return response()->json(['message' => 'Image not found'], 404);
        }
        return response()->json([
            'message' => 'Image retrieved successfully',
            'image' => $image
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $image = Image::find($id);
            if (is_null($image)) {
                return response()->json(['message' => 'Image not found'], 404);
            }
            if ($request->hasFile('image')) {
                // Delete the existing image from storage
                Storage::disk('')->delete($image->image_url);

                // Store the new image
                $imagePath = $request->file('image')->store('public/images');

                $image->image_url = $imagePath;
                $image->save();

                return response()->json([
                    'message' => 'Image updated successfully',
                    'image' => $image
                ], 200);
            }
            return response()->json([
                'error' => 'No image file provided'
            ], 400);
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
        $image = Image::find($id);
        if (is_null($image)) {
            return response()->json(['message' => 'Image not found'], 404);
        }
        // Delete the existing image from storage
        Storage::disk('')->delete($image->image_url);

        $image->delete();
        return response()->json(['message' => 'Image was deleted'], 200);
    }
}
