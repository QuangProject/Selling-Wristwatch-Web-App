<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Action index()
    public function index()
    {
        return view('admin.order.index');
    }
}
