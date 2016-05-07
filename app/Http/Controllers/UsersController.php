<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Http\Requests;
use App\Helpers\PhotoService;
use App\Http\Requests\UserProfileRequest;
use Mail;

class UsersController extends Controller
{

	function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    /**
     * Show user's booking .
     *
     * @return \Illuminate\Http\Response
     */
    public function booking()
    {
    	$user = auth()->user();
    	$collection = $user->tickets()->orderBy('depart_date', 'desc')->paginate(10);

    	// $collection = $user->tickets->merge($user->rents)->sortByDesc('depart_date');
    	
    	// //Get current page form url e.g. &page=6
     //    $currentPage = LengthAwarePaginator::resolveCurrentPage();

     //    //Define how many items we want to be visible in each page
     //    $perPage = 10;

     //    //Slice the collection to get the items to display in current page
     //    $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();

     //    //Create our paginator and pass it to the view
     //    $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);

     //    $paginatedSearchResults->setPath('dashboard');

        return view('frontend.users.booking', ['collection' => $collection], compact('user'));
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
            $photo = $this->photoService->create($request->file('photo'), [
            'owner_type'    =>  get_class($user),
            'owner_id'      =>  $user->id,
            'title'         => 'test'
            ]);
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
