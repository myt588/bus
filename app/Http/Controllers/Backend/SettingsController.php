<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Metas;
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
        if ($this->user->can('admin'))
        {
            $item = Metas::byKey('site_policy')->first()->value;
        } else {
            $item = $this->user->company->policy;
        }
        $route = 'admin::settings.policy.upload';
        return view('backend.settings.editor', compact('item', 'route'));
    }

    /**
     * Modify the company policy.
     *
     * @return Response
     */
    public function policyUpload(Request $request)
    {
        if ($this->user->can('admin'))
        {
            Metas::createOrUpdate('site_policy', $request->item);
        } else {
            $this->user->company->policy = $request->item;
            $this->user->company->save();
        }
        Session::flash('success', 'Policy Uploaded!');
        return redirect()->back();
    }

    /**
     * site setting show
     *
     * @return view
     * @author me
     **/
    public function siteSetting()
    {
        return view('backend.settings.site');
    }

    /**
     * site setting modify
     *
     * @return redirect 
     * @author 
     **/
    public function siteSettingUpload(Request $request)
    {
        return redirect()->back();
    }

    /**
     * site setting show
     *
     * @return view
     * @author me
     **/
    public function payment()
    {
        if ($this->user->cannot('admin')){ return redirect()->back(); }
        $item = Metas::byKey('site_payment')->first()->value;
        $route = 'admin::settings.site.payment.upload';
        return view('backend.settings.editor', compact('item', 'route'));
    }

    /**
     * site setting modify
     *
     * @return redirect 
     * @author 
     **/
    public function paymentUpload(Request $request)
    {
        if ($this->user->cannot('admin')){ return redirect()->back(); }
        Metas::createOrUpdate('site_payment', $request->item);
        Session::flash('success', 'Payment Rule Uploaded!');
        return redirect()->back();
    }

}
