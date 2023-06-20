<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // Select cart with image
        $carts = DB::table('carts as c')
            ->join('watches as w', 'c.watch_id', '=', 'w.id')
            ->join(DB::raw('(SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as i'), 'w.id', '=', 'i.watch_id')
            ->select('c.id', 'c.watch_id', 'c.quantity', 'w.model', 'w.selling_price', 'w.gender', 'i.id as image_id')
            ->where('c.user_id', $user->id)
            ->get();
        // Get total price
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->selling_price * $cart->quantity;
        }
        return view('clients.cart.index')->with('carts', $carts)->with('totalPrice', $totalPrice);
    }

    public function list()
    {
        // Get current user
        $user = auth()->user();
        $carts = DB::table('carts as c')
            ->join('watches as w', 'c.watch_id', '=', 'w.id')
            ->join(DB::raw('(SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as i'), 'w.id', '=', 'i.watch_id')
            ->select('c.id', 'c.watch_id', 'c.quantity', 'w.model', 'w.selling_price', 'w.gender', 'i.id as image_id')
            ->where('c.user_id', $user->id)
            ->get();
        return response()->json([
            'message' => 'Categories retrieved successfully',
            'carts' => $carts
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $user_id = $request->input('user_id');
            $watch_id = $request->input('watch_id');
            $quantity = $request->input('quantity');
            $user = User::find($user_id);
            if (is_null($user)) {
                return response()->json(['message' => 'User not found'], 404);
            }
            // Check if product is exist in cart
            $check = Cart::where('user_id', $user->id)->where('watch_id', $request->input('watch_id'))->first();
            if ($check) {
                // Check stock of watch
                $watch = Watch::find($watch_id);
                if ($check->quantity + $quantity > $watch->stock) {
                    return response()->json(['message' => 'Quantity in stock is not enough'], 400);
                }
                $check->quantity += $quantity;
                $check->save();
                return response()->json([
                    'message' => 'Add to cart successfully',
                    'cart' => $check
                ], 200);
            }
            // Create new cart
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->watch_id = $watch_id;
            $cart->quantity = $quantity;
            $cart->save();

            // Update session
            $cartItems = Cart::where('user_id', $user->id)->count();
            session()->put('countCart', $cartItems);

            return response()->json([
                'message' => 'Add to cart successfully',
                'cart' => $cart
            ], 201);
            return response()->json([
                'message' => 'Add to cart successfully',
                'user' => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Cart created failed',
                'error' => $th
            ], 400);
        }
    }

    public function show($id)
    {
        $cart = Cart::find($id);
        if (is_null($cart)) {
            return response()->json(['message' => 'Cart not found'], 404);
        }
        return response()->json([
            'message' => 'Cart retrieved successfully',
            'cart' => $cart
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $cart = Cart::find($id);

            // Check if cart is exist
            if (is_null($cart)) {
                return response()->json(['message' => 'Cart not found'], 404);
            }

            // Check stock of watch
            $watch = Watch::find($cart->watch_id);
            if ($request->input('action') == 'plus' && $cart->quantity + 1 > $watch->stock) {
                return response()->json(['message' => 'Quantity in stock is not enough'], 400);
            }

            // Update cart
            if ($request->input('action') == 'plus') {
                $cart->quantity += 1;
            } else if ($request->input('action') == 'minus') {
                $cart->quantity -= 1;
            }
            $cart->save();

            return response()->json([
                'message' => 'Cart updated successfully',
                'cart' => $cart
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Category updated failed',
                'error' => $th
            ], 400);
        }
    }

    public function destroy(Request $request, $id)
    {
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        $cart = Cart::find($id);
        if (is_null($cart)) {
            return response()->json(['message' => 'Cart not found'], 404);
        }
        $cart->delete();
        return response()->json([
            'message' => 'Cart deleted successfully',
            'cart' => $cart
        ], 200);
    }
}
