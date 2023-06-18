<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Watch;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Action index()
    public function index()
    {
        return view('clients.home');
    }

    // Action shop()
    public function shop(Request $request)
    {
        $watches = null;
        if ($request->has('brand_id')) {
            $brandId = $request->input('brand_id');
            $watches = Watch::with('images')
                ->join('collections', 'watches.collection_id', '=', 'collections.id')
                ->select('watches.id', 'watches.selling_price', 'watches.discount')
                ->where('collections.brand_id', $brandId)
                ->get();
        } elseif ($request->has('collection_id')) {
            $collectionId = $request->input('collection_id');
            $watches = Watch::with('images')
                ->select('id', 'selling_price', 'discount')
                ->where('collection_id', $collectionId)
                ->get();
        } elseif ($request->has('category_id')) {
            $categoryId = $request->input('category_id');
            $watches = Watch::with('images')
                ->join('watch_categories', 'watches.id', '=', 'watch_categories.watch_id')
                ->select('watches.id', 'watches.selling_price', 'watches.discount')
                ->where('watch_categories.category_id', $categoryId)
                ->get();
        } else {
            $watches = Watch::with('images')
                ->select('id', 'selling_price', 'discount')
                ->get();
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
