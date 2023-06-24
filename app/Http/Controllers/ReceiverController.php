<?php

namespace App\Http\Controllers;

use App\Models\Receiver;
use Illuminate\Http\Request;

class ReceiverController extends Controller
{
    public function index()
    {
        $receivers = Receiver::all();
        // Separate subaddress from address
        for ($i = 0; $i < count($receivers); $i++) {
            $getAddress = $receivers[$i]->address;
            $address = '';
            $subAddress = '';
            $addressArr = explode(', ', $getAddress);
            // dd($addressArr);
            for ($j = count($addressArr) - 1; $j >= 0; $j--) {
                if ($j < 2) {
                    $subAddress = $addressArr[$j] . ', ' . $subAddress;
                } else {
                    $address = $addressArr[$j] . ', ' . $address;
                }
            }
            // Remove the last comma from $subAddress
            $subAddress = rtrim($subAddress, ', ');
            // Remove the last comma from $address
            $address = rtrim($address, ', ');
            
            $receivers[$i]->address = $address;
            $receivers[$i]->sub_address = $subAddress;
        }
        return view('clients.receiver.index')->with('receivers', $receivers);
    }

    public function list()
    {
        $receivers = Receiver::all();
        return response()->json([
            'message' => 'Receivers retrieved successfully',
            'receivers' => $receivers
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            // Check if first and last name is exist
            $check = Receiver::where('user_id', $userId)
                ->where('first_name', $request->input('first_name'))
                ->where('last_name', $request->input('last_name'))
                ->first();
            if ($check) {
                return response()->json(['message' => 'Receiver already exist'], 400);
            }
            $receiver = Receiver::create($request->all());
            return response()->json([
                'message' => 'Receiver created successfully',
                'receiver' => $receiver
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Receiver created failed',
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
