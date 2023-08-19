<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $products = $request->get('products');
        $shippingFee = $request->get('shippingFee');
        $lineItems = [];
        $allPrice = 0;

        foreach ($products as $product) {
            $totalPrice = $product['totalPrice'];
            $total = $totalPrice * 100;
            $allPrice += $total;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $total,
                    'product_data' => [
                        'name' => $product['name'],
                        'images' => [$product['image']],
                    ],
                ],
                'quantity' => $product['quantity'],
            ];
        }

        // Add shipping fee as a separate line item
        $lineItems[] = [
            'price_data' => [
                'currency' => 'USD',
                'unit_amount' => $shippingFee * 100,
                'product_data' => [
                    'name' => 'Shipping Fee',
                    'images' => [], // Add shipping fee image URL if available
                ],
            ],
            'quantity' => 1, // Quantity of 1 for shipping fee
        ];

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success', ['totalPrice' => $allPrice / 100, 'shippingFee' => $shippingFee]),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function stripeSuccess(Request $request)
    {
        $user = auth()->user();
        $totalPrice = $request->get('totalPrice');
        $shippingFee = $request->get('shippingFee');

        // Create order
        $order = DB::table('orders')
            ->insertGetId([
                'user_id' => $user->id,
                'order_date' => now(),
                'delivery_date' => now()->addDays(7),
                'receiver_name' => $user->firstname . ' ' . $user->lastname,
                'receiver_telephone' => $user->telephone,
                'receiver_address' => $user->address,
                'shipping_fee' => $shippingFee,
                'total_price' => $totalPrice,
                'status' => 1,
                'payment_method' => 'Stripe',
                'created_at' => now(),
                'updated_at' => now()
            ]);

        // Find watch in cart of user
        $carts = Cart::where('user_id', $user->id)->get();

        // Create new order detail
        foreach ($carts as $cart) {
            $watch = Watch::find($cart->watch_id);
            DB::table('order_details')
                ->insert([
                    'order_id' => $order,
                    'watch_id' => $cart->watch_id,
                    'quantity' => $cart->quantity,
                    'price' => $watch->selling_price * $cart->quantity,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            // Update quantity of watch
            $watch->stock = $watch->stock - $cart->quantity;
            $watch->save();
        }

        // Delete cart of user
        DB::table('carts')
            ->where('user_id', $user->id)
            ->delete();

        session()->flash('msg', 'Payment successfully!');
        return redirect()->route('cart');
    }

    public function stripeCancel(Request $request)
    {
        session()->flash('error', 'Payment failed!');
        return redirect()->route('cart');
    }
}
