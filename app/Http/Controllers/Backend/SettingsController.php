<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class SettingsController extends Controller
{
	function __construct()
    {
        $this->user = Auth::user();
        // $this->middleware('auth', ['only' => ['store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function profile()
    {
    	$user = $this->user;
        return view('backend.settings.profile', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
    	$this->validate($request, [
        	'photo' => 'required',
    	]);
    	$user = $this->user;
    	$photo = Photo::fromForm($request->file('photo'), $user->id, get_class($user));
        $user->photo = $photo->url;
        $user->save();
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function template(Request $request)
    {
    	
        return view('backend.404');
    }

    /**
     * Modify the company policy.
     *
     * @return Response
     */
    public function policy()
    {
        $policy = $this->user->company->policy;
        return view('backend.settings.policy', compact('policy'));
    }

    /**
     * Modify the company policy.
     *
     * @return Response
     */
    public function policyUpload(Request $request)
    {
        $this->user->company->policy = $request->policy;
        $this->user->company->save();
        Session::flash('success', 'Policy Uploaded!');
        return redirect()->back();
    }


}
