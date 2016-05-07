<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\PhotoService;
use Auth;

class SettingsController extends Controller
{
	function __construct(PhotoService $photoService)
    {
        $this->user = Auth::user();
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


}
