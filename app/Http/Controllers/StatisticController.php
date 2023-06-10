<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    // Action dashboard()
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
