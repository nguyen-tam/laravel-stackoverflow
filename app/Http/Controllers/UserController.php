<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Image;

class UserController extends Controller
{
    //
    public function showProfile() {
  		$user = Auth::user();
  		return view('profile.index', ['user' => Auth::user()] );
  	}

  	public function uploadAvatar(Request $request) {

  		// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return redirect('/users/' . Auth::user()->id );

  	}

  	public function updateProfile() {

		$user = Auth::user();
		$user->name = Input::get("display_name");
		$user->location = Input::get("location");
		$user->title = Input::get("title");
		$user->save();

		return redirect('/users/' . Auth::user()->id );

  	}
}
