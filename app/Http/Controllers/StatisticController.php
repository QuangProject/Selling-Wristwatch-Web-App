<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Watch;
use Carbon\Carbon;
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
    }

    public function sale($type)
    {
        if ($type == 'day') {
            return $this->saleByDay();
        } else if ($type == 'month') {
            return $this->saleByMonth();
        } else if ($type == 'year') {
            return $this->saleByYear();
        }
    }

    public function saleByDay()
    {
        try {
            // SELECT DATE(order_date) AS sale_day, COUNT(*) AS sales_count
            // FROM orders
            // WHERE DATE(order_date) >= CURDATE() - INTERVAL 1 DAY AND DATE(order_date) <= CURDATE() AND status >=2
            // GROUP BY sale_day
            // ORDER BY sale_day DESC
            $sales = Order::selectRaw('DATE(order_date) AS sale_day, COUNT(*) AS sales_count')
                ->whereDate('order_date', '>=', Carbon::today()->subDay())
                ->whereDate('order_date', '<=', Carbon::today())
                ->where('status', '>=', 2)
                ->groupBy('sale_day')
                ->orderBy('sale_day', 'DESC')
                ->get();

            $percentDifference = (($sales[0]->sales_count - $sales[1]->sales_count) / $sales[1]->sales_count) * 100;

            return response()->json([
                'sales' => $sales,
                'percentDifference' => number_format($percentDifference, 2)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error when get sale number by day',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function saleByMonth()
    {
        try {
            // SELECT YEAR(order_date) AS sale_year, MONTH(order_date) AS sale_month, COUNT(*) AS sales_count
            // FROM orders
            // WHERE ((YEAR(order_date) = YEAR(CURDATE()) AND MONTH(order_date) = MONTH(CURDATE())) OR (YEAR(order_date) = YEAR(CURDATE() - INTERVAL 1 MONTH) AND MONTH(order_date) = MONTH(CURDATE() - INTERVAL 1 MONTH))) AND status = 4
            // GROUP BY sale_year, sale_month
            // ORDER BY sale_month DESC
            $sales = Order::selectRaw('YEAR(order_date) AS sale_year, MONTH(order_date) AS sale_month, COUNT(*) AS sales_count')
                ->where(function ($query) {
                    $query->whereYear('order_date', '=', Carbon::now()->year)
                        ->whereMonth('order_date', '=', Carbon::now()->month)
                        ->where('status', '=', 4);
                })
                ->orWhere(function ($query) {
                    $query->whereYear('order_date', '=', Carbon::now()->subMonth()->year)
                        ->whereMonth('order_date', '=', Carbon::now()->subMonth()->month)
                        ->where('status', '=', 4);
                })
                ->groupBy('sale_year', 'sale_month')
                ->orderByDesc('sale_month')
                ->get();

            $percentDifference = (($sales[0]->sales_count - $sales[1]->sales_count) / $sales[1]->sales_count) * 100;

            return response()->json([
                'sales' => $sales,
                'percentDifference' => number_format($percentDifference, 2)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error when get sale number by month',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function saleByYear()
    {
        try {
            // SELECT YEAR(order_date) AS sale_year, COUNT(*) AS sales_count
            // FROM orders
            // WHERE (YEAR(order_date) = YEAR(CURDATE()) AND MONTH(order_date) <= MONTH(CURDATE()) AND status = 4) OR (YEAR(order_date) = YEAR(CURDATE()) - 1 AND status = 4)
            // GROUP BY sale_year
            // ORDER BY sale_year DESC
            $sales = Order::selectRaw('YEAR(order_date) AS sale_year, COUNT(*) AS sales_count')
                ->where(function ($query) {
                    $query->whereYear('order_date', '=', Carbon::now()->year)
                        ->whereMonth('order_date', '<=', Carbon::now()->month)
                        ->where('status', '=', 4);
                })
                ->orWhere(function ($query) {
                    $query->whereYear('order_date', '=', Carbon::now()->subYear()->year)
                        ->where('status', '=', 4);
                })
                ->groupBy('sale_year')
                ->orderByDesc('sale_year')
                ->get();

            $percentDifference = (($sales[0]->sales_count - $sales[1]->sales_count) / $sales[1]->sales_count) * 100;

            return response()->json([
                'sales' => $sales,
                'percentDifference' => number_format($percentDifference, 2)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error when get sale number by year',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function revenue($type)
    {
        if ($type == 'day') {
            return $this->revenueByDay();
        } else if ($type == 'month') {
            return $this->revenueByMonth();
        } else if ($type == 'year') {
            return $this->revenueByYear();
        }
    }

    public function revenueByDay()
    {
        try {
            // SELECT DATE(delivery_date) AS revenue_day, SUM(total_price) AS revenue
            // FROM orders
            // WHERE DATE(delivery_date) >= CURDATE() - INTERVAL 1 DAY AND DATE(delivery_date) <= CURDATE() AND status = 4
            // GROUP BY revenue_day
            // ORDER BY revenue_day DESC
            $revenues = Order::selectRaw('DATE(delivery_date) AS revenue_day, SUM(total_price) AS revenue')
                ->whereDate('delivery_date', '>=', Carbon::today()->subDay())
                ->whereDate('delivery_date', '<=', Carbon::today())
                ->where('status', '=', 4)
                ->groupBy('revenue_day')
                ->orderBy('revenue_day', 'DESC')
                ->get();

            $percentDifference = (($revenues[0]->revenue - $revenues[1]->revenue) / $revenues[1]->revenue) * 100;

            return response()->json([
                'revenues' => $revenues,
                'percentDifference' => number_format($percentDifference, 2)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error when get revenue by day',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function revenueByMonth()
    {
        try {
            // SELECT YEAR(delivery_date) AS revenue_year, MONTH(delivery_date) AS revenue_month, SUM(total_price) AS revenue
            // FROM orders
            // WHERE ((YEAR(delivery_date) = YEAR(CURDATE()) AND MONTH(delivery_date) = MONTH(CURDATE())) OR (YEAR(delivery_date) = YEAR(CURDATE() - INTERVAL 1 MONTH) AND MONTH(delivery_date) = MONTH(CURDATE() - INTERVAL 1 MONTH))) AND status = 4
            // GROUP BY revenue_year, revenue_month
            // ORDER BY revenue_month DESC
            $revenues = Order::selectRaw('YEAR(delivery_date) AS revenue_year, MONTH(delivery_date) AS revenue_month, SUM(total_price) AS revenue')
                ->where(function ($query) {
                    $query->whereYear('delivery_date', '=', Carbon::now()->year)
                        ->whereMonth('delivery_date', '=', Carbon::now()->month)
                        ->where('status', '=', 4);
                })
                ->orWhere(function ($query) {
                    $query->whereYear('delivery_date', '=', Carbon::now()->subMonth()->year)
                        ->whereMonth('delivery_date', '=', Carbon::now()->subMonth()->month)
                        ->where('status', '=', 4);
                })
                ->groupBy('revenue_year', 'revenue_month')
                ->orderByDesc('revenue_month')
                ->get();

            $percentDifference = (($revenues[0]->revenue - $revenues[1]->revenue) / $revenues[1]->revenue) * 100;

            return response()->json([
                'revenues' => $revenues,
                'percentDifference' => number_format($percentDifference, 2)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error when get revenue by month',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function revenueByYear()
    {
        try {
            // SELECT YEAR(delivery_date) AS revenue_year, SUM(total_price) AS revenue
            // FROM orders
            // WHERE (YEAR(delivery_date) = YEAR(CURDATE()) AND MONTH(delivery_date) <= MONTH(CURDATE()) AND status = 4) OR (YEAR(delivery_date) = YEAR(CURDATE()) - 1 AND status = 4)
            // GROUP BY revenue_year
            // ORDER BY revenue_year DESC
            $revenues = Order::selectRaw('YEAR(delivery_date) AS revenue_year, SUM(total_price) AS revenue')
                ->where(function ($query) {
                    $query->whereYear('delivery_date', '=', Carbon::now()->year)
                        ->whereMonth('delivery_date', '<=', Carbon::now()->month)
                        ->where('status', '=', 4);
                })
                ->orWhere(function ($query) {
                    $query->whereYear('delivery_date', '=', Carbon::now()->subYear()->year)
                        ->where('status', '=', 4);
                })
                ->groupBy('revenue_year')
                ->orderByDesc('revenue_year')
                ->get();

            $percentDifference = (($revenues[0]->revenue - $revenues[1]->revenue) / $revenues[1]->revenue) * 100;

            return response()->json([
                'revenues' => $revenues,
                'percentDifference' => number_format($percentDifference, 2)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error when get revenue by year',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function chart($type)
    {
        if ($type == 'line') {
            return $this->lineChart();
        } else if ($type == 'pie') {
            return $this->pieChart();
        }
    }

    public function lineChart()
    {
        try {
            // SELECT YEAR(order_date) AS sale_year, MONTH(order_date) AS sale_month, COUNT(*) AS sales_count
            // FROM orders
            // WHERE YEAR(delivery_date) = YEAR(CURDATE()) AND
            // STATUS = 4
            // GROUP BY sale_year, sale_month
            // ORDER BY sale_month DESC
            $sales = Order::selectRaw('YEAR(order_date) AS sale_year, MONTH(order_date) AS sale_month, COUNT(*) AS sales_count')
                ->whereYear('delivery_date', '=', date('Y'))
                ->where('status', '=', 4)
                ->groupBy('sale_year', 'sale_month')
                ->orderBy('sale_month')
                ->get();

            return response()->json([
                'sales' => $sales
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error when get sale in line chart',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
