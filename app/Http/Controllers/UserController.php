<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Action profile()
    public function profile()
    {
        $user = auth()->user();
        if ($user->password == "") {
            return redirect()->route('create.password');
        }
        return view('clients.user.profile')->with('user', $user);
    }

    // Action createPassword()
    public function createPassword()
    {
        $user = auth()->user();
        if ($user->password != "") {
            return redirect()->route('home');
        }
        return view('clients.user.create-password');
    }

    // Action savePassword()
    public function savePassword(Request $request)
    {
        try {
            $user = auth()->user();
            $newPassword = Hash::make($request->password);
            $user->update([
                'password' => $newPassword
            ]);

            return response()->json([
                'message' => 'Password created successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
                'message' => 'Password created failed'
            ], 500);
        }
    }

    // Action edit()
    public function edit(Request $request)
    {
        try {
            $user = auth()->user();
            $user->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'telephone' => $request->telephone,
                'address' => $request->address
            ]);

            return response()->json([
                'message' => 'Edit profile successfully'
            ], 200);
        } catch (\Throwable $th) {
            // return redirect()->back()->with('error', $th->getMessage());
            return response()->json([
                'error' => $th->getMessage(),
                'message' => 'Edit profile failed'
            ], 500);
        }
    }

    // Action editPassword()
    public function editPassword(Request $request)
    {
        try {
            $user = auth()->user();
            $oldPassword = $request->oldPassword;
            $newPassword = $request->newPassword;

            if (!Hash::check($oldPassword, $user->password)) {
                return response()->json([
                    'message' => 'Old password is incorrect'
                ], 400);
            }

            $user->update([
                'password' => Hash::make($newPassword)
            ]);

            return response()->json([
                'message' => 'Edit password successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
                'message' => 'Edit password failed'
            ], 500);
        }
    }
}
