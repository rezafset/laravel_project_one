<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       return view('backend_pages.dashboard');
    }
    public function test(){
        return view('backend_pages.test');
    }
}
