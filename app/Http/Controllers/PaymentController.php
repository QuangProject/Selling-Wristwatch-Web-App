<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_SECRET'));
        $this->gateway->setTestMode(env('PAYPAL_TEST_MODE'));
    }

    public function index()
    {
        $user = auth()->user();
        // Get receivers of user
        $receivers = DB::table('receivers')
            ->select('id', 'first_name', 'last_name')
            ->where('user_id', $user->id)
            ->get();
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
        return view('clients.payment.index')->with('carts', $carts)->with('totalPrice', $totalPrice)->with('receivers', $receivers);
    }

    public function paypal()
    {
        try {
            $response = $this->gateway->purchase([
                'amount' => request('amount'),
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => route('paypal.success'),
                'cancelUrl' => route('paypal.cancel'),
            ])->send();

            if ($response->isRedirect()) {
                // Redirect to offsite payment gateway
                $response->redirect();
            } else {
                // Payment failed
                return $response->getMessage();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function success(Request $request)
    {
        // dd($request->all());
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ]);

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // dd($response->getData());

                $arr = $response->getData();

                Payment::create([
                    'payment_id' => $arr['id'],
                    'payer_id' => $arr['payer']['payer_info']['payer_id'],
                    'payer_email' => $arr['payer']['payer_info']['email'],
                    'amount' => $arr['transactions'][0]['amount']['total'],
                    'currency' => $arr['transactions'][0]['amount']['currency'],
                    'payment_status' => $arr['state']
                ]);

                $user = auth()->user();
                // Create new receiver
                $firstNames = $arr['payer']['payer_info']['first_name'];
                $lastNames = $arr['payer']['payer_info']['last_name'];
                $addresses = $arr['payer']['payer_info']['shipping_address']['line1'] . ', ' . $arr['payer']['payer_info']['shipping_address']['city'] . ', ' . $arr['payer']['payer_info']['shipping_address']['state'] . ', ' . $arr['payer']['payer_info']['shipping_address']['postal_code'] . ', ' . $arr['payer']['payer_info']['shipping_address']['country_code'];

                // Create new order
                $shippingFee = 0;
                $totalPrice = $arr['transactions'][0]['amount']['total'];

                $order = DB::table('orders')
                    ->insertGetId([
                        'user_id' => $user->id,
                        'order_date' => now(),
                        'delivery_date' => now()->addDays(7),
                        'receiver_name' => $firstNames . ' ' . $lastNames,
                        'receiver_telephone' => $user->telephone,
                        'receiver_address' => $addresses,
                        'shipping_fee' => $shippingFee,
                        'total_price' => $totalPrice,
                        'status' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                // Find watch in cart of user
                $carts = Cart::where('user_id', $user->id)->get();
                $totalPriceInOrderDetail = 0;
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

                    $totalPriceInOrderDetail += $watch->selling_price * $cart->quantity;
                }

                // Delete cart of user
                DB::table('carts')
                    ->where('user_id', $user->id)
                    ->delete();

                // Update shipping fee
                $shippingFee = $totalPrice - $totalPriceInOrderDetail;
                DB::table('orders')
                    ->where('id', $order)
                    ->update([
                        'shipping_fee' => $shippingFee
                    ]);

                session()->flash('msg', 'Payment successfully!');
                return redirect()->route('cart');
            } else {
                // Payment failed
                return $response->getMessage();
            }
        } else {
            session()->flash('error', 'Payment failed');
            return redirect()->route('cart');
        }
    }

    public function cancel(Request $request)
    {
        session()->flash('error', 'Payment failed!');
        return redirect()->route('cart');
    }

    public function error()
    {
        session()->flash('error', 'Payment failed!');
        return redirect()->route('cart');
    }
}
