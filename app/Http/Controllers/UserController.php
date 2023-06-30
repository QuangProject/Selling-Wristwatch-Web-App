<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    // Action orderInformation()
    public function orderInformation()
    {
        $user = auth()->user();
        $orders = Order::join('receivers', 'orders.receiver_id', '=', 'receivers.id')
            ->join('users', 'receivers.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.order_date', 'orders.delivery_date', 'orders.shipping_fee', 'orders.total_price', 'orders.status')
            ->where('receivers.user_id', $user->id)
            ->whereNotIn('orders.status', [4])
            ->orderBy('orders.delivery_date', 'desc')
            ->get();
        return view('clients.order.index')->with('orders', $orders);
    }

    // Action detailedInformation()
    public function detailedInformation($id)
    {
        $orderDetail = DB::table('order_details as od')
            ->join('orders as o', 'od.order_id', '=', 'o.id')
            ->join('watches as w', 'od.watch_id', '=', 'w.id')
            ->join(DB::raw('(SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as i'), 'w.id', '=', 'i.watch_id')
            ->select('od.order_id', 'od.watch_id', 'od.quantity', 'od.price', 'w.model', 'w.selling_price', 'w.gender', 'i.id as image_id', 'o.shipping_fee', 'o.total_price')
            ->where('od.order_id', $id)
            ->get();
        return view('clients.order.detail')->with('orderDetails', $orderDetail);
    }

    // Action purchaseHistory()
    public function purchaseHistory()
    {
        $user = auth()->user();
        $purchaseHistories = Order::join('receivers', 'orders.receiver_id', '=', 'receivers.id')
            ->join('users', 'receivers.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.delivery_date', 'orders.shipping_fee', 'orders.total_price')
            ->where('receivers.user_id', $user->id)
            ->where('orders.status', 4)
            ->orderBy('orders.delivery_date', 'desc')
            ->get();
        return view('clients.history.index')->with('purchaseHistories', $purchaseHistories);
    }
}
