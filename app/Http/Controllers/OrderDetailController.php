<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\Watch;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    // Action store()
    public function store(Request $request)
    {
        $userId = $request->input('user_id');
        $orderId = $request->input('order_id');

        // Find watch in cart of user
        $carts = Cart::where('user_id', $userId)->get();
        // iterate through cart
        foreach ($carts as $cart) {
            $watch = Watch::find($cart->watch_id);
            // Add watch to order detail
            OrderDetail::create([
                'order_id' => $orderId,
                'watch_id' => $cart->watch_id,
                'quantity' => $cart->quantity,
                'price' => $watch->selling_price * $cart->quantity
            ]);

            // Update quantity of watch
            $watch->stock = $watch->stock - $cart->quantity;
            $watch->save();
        }

        // Delete cart of user
        Cart::where('user_id', $userId)->delete();

        return response()->json([
            'message' => 'Order detail created successfully'
        ], 201);
    }
}
