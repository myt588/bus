<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


class UsersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
    	$user = auth()->user();
    	$tickets = $user->tickets()->orderBy('depart_date', 'desc')->paginate(15);
        return view('frontend.users.dashboard', compact('tickets'));
    }
}
