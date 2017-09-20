<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = auth()->user();

        return view('pages.user.home')->with(compact('user'));
    }

    public function showUserRegistrationForm() {
        $user = auth()->user();

        if ($user->role == 'administrator') {

        }

        if ($user->role == 'partner') {

        }
    }
}
