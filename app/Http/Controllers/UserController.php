<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show all users
     *
     * @return View
     */
    public function index() : View
    {
        $users = DB::table('users')->paginate(10);
        return view('user-listing', ['users' => $users]);
    }
}
