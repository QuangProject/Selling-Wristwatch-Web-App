<?php

namespace App\Http\Controllers;

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
    public function detail()
    {
        return view('clients.site.detail');
    }
}
