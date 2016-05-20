<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\PhotoService;
use Auth;
use Session;

class SettingsController extends Controller
{
	function __construct(PhotoService $photoService)
    {
        $this->user = Auth::user();
        $this->company = $this->user->company;
        $this->photoService = $photoService;
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
    	$photo = $this->photoService->create($request->file('photo'), [
            'owner_type'    =>  get_class($user),
            'owner_id'      =>  $user->id,
            'title'         => 'test'
            ]);
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
        $policy = $this->company->policy;
        return view('backend.settings.policy', compact('policy'));
    }

    /**
     * Modify the company policy.
     *
     * @return Response
     */
    public function policyUpload(Request $request)
    {
        $this->company->policy = $request->policy;
        $this->company->save();
        Session::flash('success', 'Policy Uploaded!');
        return redirect()->back();
    }


}
