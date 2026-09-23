<?php

namespace App\Http\Controllers\Admin;

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