<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Action index()
    public function index()
    {
        $orders = Order::join('receivers', 'orders.receiver_id', '=', 'receivers.id')
            ->select('orders.id', 'orders.order_date', 'orders.delivery_date', 'orders.shipping_fee', 'orders.total_price', 'orders.status', 'receivers.first_name', 'receivers.last_name', 'receivers.telephone', 'receivers.address')
            ->get();
        return view('admin.order.index')->with('orders', $orders);
        // return response()->json([
        //     'message' => 'Get all orders successfully',
        //     'orders' => $orders
        // ], 200);
    }

    // Action store()
    public function store(Request $request)
    {
        $receiverId = $request->input('receiver_id');
        $shippingFee = $request->input('shipping_fee');
        $totalPrice = $request->input('total_price');

        $order = Order::create([
            'receiver_id' => $receiverId,
            'order_date' => now(),
            'delivery_date' => now()->addDays(7),
            'shipping_fee' => $shippingFee,
            'total_price' => $totalPrice,
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 201);
    }

    // Action detail()
    public function detail($id)
    {
        $orderDetal = DB::table('order_details as od')
            ->join('watches as w', 'od.watch_id', '=', 'w.id')
            ->join(DB::raw('(SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as i'), 'w.id', '=', 'i.watch_id')
            ->select('od.order_id', 'od.watch_id', 'od.quantity', 'od.price', 'w.model', 'w.selling_price', 'w.gender', 'i.id as image_id')
            ->where('od.order_id', $id)
            ->get();
        return view('admin.order.detail')->with('orderDetals', $orderDetal);
    }

    // Action update()
    public function update(Request $request, $id)
    {
        $status = $request->input('status');

        $order = Order::find($id);
        $order->status = $status;
        $order->save();

        return response()->json([
            'message' => 'Order updated successfully',
            'order' => $order
        ], 200);
    }
}
