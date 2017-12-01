<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Gets the information of the user and redirects according to role.
     *
     * @return \Illuminate\Http\Response
     */
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
