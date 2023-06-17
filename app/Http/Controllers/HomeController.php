<?php

namespace App\Http\Controllers;

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
    public function shop()
    {
        return view('clients.site.shop');
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
