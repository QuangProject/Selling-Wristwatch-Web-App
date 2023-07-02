<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // Action index()
    public function index()
    {
        $user = auth()->user();
        // Check user role
        if ($user && $user->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }

        // Get 6 brands best seller
        // SELECT b.id, b.name, COUNT(b.id) as brand_count, SUM(od.quantity) as total_quantity
        // FROM brands as b 
        // LEFT JOIN collections as c ON b.id = c.brand_id
        // LEFT JOIN watches as w ON w.collection_id = c.id 
        // LEFT JOIN order_details as od ON od.watch_id = w.id 
        // GROUP BY b.id, b.name
        // ORDER BY brand_count DESC, b.updated_at DESC LIMIT 4
        $brands = Brand::select('brands.id', 'brands.name')
            ->selectRaw('COUNT(brands.id) as brand_count')
            ->selectRaw('SUM(order_details.quantity) as total_quantity')
            ->leftJoin('collections', 'brands.id', '=', 'collections.brand_id')
            ->leftJoin('watches', 'watches.collection_id', '=', 'collections.id')
            ->leftJoin('order_details', 'order_details.watch_id', '=', 'watches.id')
            ->groupBy('brands.id', 'brands.name')
            ->orderByDesc('brand_count')
            ->orderByDesc('brands.updated_at')
            ->limit(4)
            ->get();

        // Get 6 watches best seller
        // SELECT w.id, w.model, w.selling_price, w.discount, i.id as image_id, COUNT(w.id) as watch_count, SUM(od.quantity) as total_quantity
        // FROM watches AS w
        // INNER JOIN (SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as i ON w.id = i.watch_id
        // LEFT JOIN order_details AS od ON od.watch_id = w.id
        // GROUP BY w.id, w.model, w.selling_price, w.discount, image_id
        // ORDER BY total_quantity DESC, w.updated_at DESC
        // LIMIT 6;
        $watches = Watch::select('watches.id', 'watches.model', 'watches.selling_price', 'watches.discount', 'images.id as image_id')
            ->selectRaw('COUNT(watches.id) as watch_count')
            ->selectRaw('SUM(order_details.quantity) as total_quantity')
            ->join(DB::raw('(SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as images'), 'watches.id', '=', 'images.watch_id')
            ->leftJoin('order_details', 'order_details.watch_id', '=', 'watches.id')
            ->groupBy('watches.id', 'watches.model', 'watches.selling_price', 'watches.discount', 'images.id')
            ->orderByDesc('total_quantity')
            ->orderByDesc('watches.updated_at')
            ->limit(6)
            ->get();

        return view('clients.home')->with('brands', $brands)->with('watches', $watches);
    }

    // Action shop()
    public function shop(Request $request)
    {
        $watches = null;
        if ($request->has('brand_id')) {
            $brandId = $request->input('brand_id');
            $watches = Watch::with('images')
                ->join('collections', 'watches.collection_id', '=', 'collections.id')
                ->select('watches.id', 'watches.model', 'watches.stock', 'watches.selling_price', 'watches.discount')
                ->where('collections.brand_id', $brandId)
                ->paginate(8);
        } elseif ($request->has('collection_id')) {
            $collectionId = $request->input('collection_id');
            $watches = Watch::with('images')
                ->select('id', 'model', 'stock', 'selling_price', 'discount')
                ->where('collection_id', $collectionId)
                ->paginate(8);
        } elseif ($request->has('category_id')) {
            $categoryId = $request->input('category_id');
            $watches = Watch::with('images')
                ->join('watch_categories', 'watches.id', '=', 'watch_categories.watch_id')
                ->select('watches.id', 'watches.model', 'watches.stock', 'watches.selling_price', 'watches.discount')
                ->where('watch_categories.category_id', $categoryId)
                ->paginate(8);
        } elseif ($request->has('gender')) {
            $gender = $request->input('gender');
            if ($gender == 'men') {
                $watches = Watch::with('images')
                    ->select('id', 'model', 'stock', 'selling_price', 'discount')
                    ->where('gender', 'Men')
                    ->paginate(8);
            } else {
                $watches = Watch::with('images')
                    ->select('id', 'model', 'stock', 'selling_price', 'discount')
                    ->where('gender', 'Women')
                    ->paginate(8);
            }
        } else {
            // $watches = Watch::with('images')
            //     ->select('id', 'model', 'stock', 'selling_price', 'discount')
            //     ->paginate(8);
            $watches = Watch::select('watches.id', 'watches.model', 'watches.stock', 'watches.selling_price', 'watches.discount', 'images.id as image_id')
                ->selectRaw('COUNT(watches.id) as watch_count')
                ->selectRaw('SUM(order_details.quantity) as total_quantity')
                ->join(DB::raw('(SELECT MIN(id) as id, watch_id FROM images GROUP BY watch_id) as images'), 'watches.id', '=', 'images.watch_id')
                ->leftJoin('order_details', 'order_details.watch_id', '=', 'watches.id')
                ->groupBy('watches.id', 'watches.model', 'watches.stock', 'watches.selling_price', 'watches.discount', 'image_id')
                ->orderByDesc('watches.updated_at')
                ->orderByDesc('total_quantity')
                ->paginate(8);
            // return response()->json([
            //     'message' => 'Get all watches successfully',
            //     'watches' => $watches
            // ], 200);
        }
        $brands = Brand::select('id', 'name')->get();
        $collections = Collection::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        return view('clients.site.shop')->with('watches', $watches)->with('brands', $brands)->with('collections', $collections)->with('categories', $categories);
    }

    // Action about()
    public function about()
    {
        return view('clients.site.about');
    }

    // Action contact()
    public function contact()
    {
        return view('clients.site.contact');
    }

    // Action detail()
    public function detail($id)
    {
        $watch = Watch::with('images')->findOrFail($id);
        return view('clients.site.detail')->with('watch', $watch);
    }
}
