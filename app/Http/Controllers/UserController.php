<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect('/admin/home');
        }

        if ($user->isPartner()) {
            return redirect('/partner/home');
        }

        if ($user->isStudent()) {
            return redirect('/student/home');
        }
    }
}
