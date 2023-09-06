<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // return view('dashboard');
        return redirect()->route('user.index');
    }

    public function login(){
        return view('auth.login');
    }
}
