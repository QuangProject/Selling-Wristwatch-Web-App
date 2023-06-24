<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        // Select cart with image
        $carts = DB::table('carts as c')
            ->join('watches as w', 'c.watch_id', '=', 'w.id')
            ->join(DB::raw('(SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as i'), 'w.id', '=', 'i.watch_id')
            ->select('c.id', 'c.watch_id', 'c.quantity', 'w.model', 'w.selling_price', 'w.discount', 'w.gender', 'i.id as image_id')
            ->where('c.user_id', $user->id)
            ->get();
        // Get total price
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->selling_price * $cart->quantity;
        }
        return view('clients.payment.index')->with('carts', $carts)->with('totalPrice', $totalPrice);
    }
}
