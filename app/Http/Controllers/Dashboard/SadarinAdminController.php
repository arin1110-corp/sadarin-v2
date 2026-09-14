<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class SadarinAdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX / DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('dashboard.index');
    }
}