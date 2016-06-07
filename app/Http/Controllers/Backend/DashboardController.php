<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{

	function __construct()
    {
        $this->user = Auth::user();
        // $this->middleware('auth', ['only' => ['store', 'destroy']]);
    }

    /**
     * get the dashboard view
     *
     * @return view
     * @author me
     **/
    public function dashboard()
    {
    	if ($this->user->isAdmin()) { return redirect()->route('admin::site.admin'); }
    	$company = $this->user->company;
		$trips = $company->tripsBetweenDates('today', 'tomorrow');
		$orders = $company->transactions;
    	return view('backend.dashboard', compact('company', 'trips', 'orders'));
    }

    /**
     * get the dashboard for site.admin
     *
     * @return view
     * @author me
     **/
    public function admin()
    {
    	return view('backend.admin');
    }
}
