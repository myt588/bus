<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Http\Requests;
use App\Http\Requests\UserProfileRequest;
use App\Photo;
use Mail;

class UsersController extends Controller
{

    /**
     * Show user's booking .
     *
     * @return \Illuminate\Http\Response
     */
    public function booking(Request $request)
    {
        $data = $request->all();
    	$user = auth()->user();
        if ($request->has('type') && $request->type == 'rental')
        {    
            $collection = $user->rents()->orderBy('start', 'desc');
        } else {
            $collection = $user->tickets()->orderBy('depart_date', 'desc');
        }
        $collection = $collection->simplePaginate(10);
        return view('frontend.users.booking', compact('user', 'collection', 'data'));
    }

    /**
     * Show user's Profile .
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth()->user();
        return view('frontend.users.profile', compact('user'));
    }

    /**
     * edit user's Profile .
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        return view('frontend.users.edit', compact('user'));
    }

    /**
     * Show user's Setting .
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        $user = auth()->user();
        return view('frontend.users.setting', compact('user'));
    }

    public function update(UserProfileRequest $request)
    {

    	$user = auth()->user();
    	$user->update($request->all());
        if ($request->has('photo')){
            $photo = Photo::fromForm($request->file('photo'), $user->id, get_class($user));
            $user->photo = $photo->url;
            $user->save();
        }
    	return redirect()->route('user.profile');
    }

    public function sendEmailReminder(Request $request, $id)
    {
        $user = User::findOrFail($id);

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');
            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }
}
