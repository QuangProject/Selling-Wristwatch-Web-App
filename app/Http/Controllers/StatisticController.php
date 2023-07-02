<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    // Action dashboard()
    public function dashboard()
    {
        // SELECT w.id, w.model, w.selling_price, w.discount, i.id as image_id, COUNT(w.id) as watch_count, SUM(od.quantity) as sold, SUM(od.price) as revenue
        // FROM watches AS w
        // INNER JOIN (SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as i ON w.id = i.watch_id
        // LEFT JOIN order_details AS od ON od.watch_id = w.id
        // LEFT JOIN orders as o ON od.order_id = o.id
        // WHERE MONTH(o.delivery_date) = MONTH(CURDATE())
        // GROUP BY w.id, w.model, w.selling_price, w.discount, image_id
        // ORDER BY sold DESC, w.updated_at DESC
        // LIMIT 6;
        $topSellingInMonth = Watch::select('watches.id', 'watches.model', 'watches.selling_price', 'watches.discount', 'images.id as image_id')
            ->selectRaw('COUNT(watches.id) as watch_count')
            ->selectRaw('SUM(order_details.quantity) as sold')
            ->selectRaw('SUM(order_details.price) as revenue')
            ->join(DB::raw('(SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as images'), 'watches.id', '=', 'images.watch_id')
            ->leftJoin('order_details', 'order_details.watch_id', '=', 'watches.id')
            ->leftJoin('orders as o', 'order_details.order_id', '=', 'o.id')
            ->whereMonth('o.delivery_date', DB::raw('MONTH(CURDATE())'))
            ->groupBy('watches.id', 'watches.model', 'watches.selling_price', 'watches.discount', 'images.id')
            ->orderByDesc('sold')
            ->orderByDesc('watches.updated_at')
            ->limit(6)
            ->get();

        $recentSale = Order::select('orders.id', 'orders.receiver_name', 'orders.total_price', 'orders.status')
            ->whereMonth('orders.delivery_date', DB::raw('MONTH(CURDATE())'))
            ->orderBy('orders.delivery_date', 'DESC')
            ->get();


        return view('admin.dashboard')->with([
            'topSellingInMonth' => $topSellingInMonth,
            'recentSale' => $recentSale
        ]);
        // return response()->json([
        //     'topSellingInMonth' => $topSellingInMonth,
        //     'recentSale' => $recentSale
        // ]);
    }

    public function revenue()
    {
        // Get revenue this month
        // SELECT MONTH(delivery_date) as this_month, SUM(total_price)
        // FROM `orders` 
        // WHERE MONTH(delivery_date) = MONTH(CURDATE())
        // GROUP BY MONTH(delivery_date)
        $revenueThisMonth  = Order::select(DB::raw('MONTH(delivery_date) as this_month'), DB::raw('SUM(total_price) as total'))
            ->whereMonth('delivery_date', DB::raw('MONTH(CURDATE())'))
            ->groupBy(DB::raw('MONTH(delivery_date)'))
            ->get();

        // Get revenue last month
        // SELECT MONTH(delivery_date) as last_month, SUM(total_price)
        // FROM `orders` 
        // WHERE MONTH(delivery_date) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
        // GROUP BY MONTH(delivery_date)
        $revenueLastMonth = Order::select(DB::raw('MONTH(delivery_date) as last_month'), DB::raw('SUM(total_price) as total'))
            ->whereMonth('delivery_date', '=', DB::raw('MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))'))
            ->groupBy(DB::raw('MONTH(delivery_date)'))
            ->get();

        $percentDifference = ($revenueThisMonth[0]->total - $revenueLastMonth[0]->total) / ($revenueLastMonth[0]->total / 100);

        return response()->json([
            'revenueThisMonth' => $revenueThisMonth[0],
            'revenueLastMonth' => $revenueLastMonth[0],
            'percentDifference' => number_format($percentDifference, 2)
        ]);
    }
}
