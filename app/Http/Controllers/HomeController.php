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

    /**
     * Checks if the user is authenticated and if so redirects to home, if not, redirects to login.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if(Auth::check())
            return redirect('/user');
        else
            return redirect('/login');
    }
}
