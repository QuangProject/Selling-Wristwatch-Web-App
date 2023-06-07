<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Action profile()
    public function profile()
    {
        return view('clients.user.profile');
    }
}
