<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index(Request $request) {
        if(Auth::check())
            return redirect('/user');
        else
            return redirect('/login');
    }
}
