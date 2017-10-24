<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Question;
use App\Answer;

use Auth;
use Image;
use Response;

class UserController extends Controller
{
    //

    public function viewOtherProfile($id) {

      $questions = Question::where('created_by', '=' , $id)
                  ->paginate(10);

      $answers_by_user = Answer::where('created_by', '=' , $id)
                  ->where('question_id', '<>', 0)
                  ->paginate(10);

      $answers = [];
      foreach ($answers_by_user as $key => $value) {
        $answers[$value->question_id] = Question::find($value->question_id);
      }
               
      return view('profile.view_other', ['questions' => $questions, 'answers' => $answers] );
    }

    public function showProfile() {
  		$user = Auth::user();
      $questions = Question::where('created_by', '=' ,Auth::user()->id)
                  ->paginate(10);

      $answers_by_user = Answer::where('created_by', '=' , Auth::user()->id)
                  ->paginate(10);

      $answers = [];
      foreach ($answers_by_user as $key => $value) {
        $answers[$value->question_id] = Question::find($value->question_id);
      }
                              
  		return view('profile.index', ['user' => Auth::user(), 'questions' => $questions, 'answers' => $answers] );
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

    public function isAuthenticated() {
      return Response::json(Auth::check());
    }

    public function getCurrentUserId() {
      return Response::json(Auth::user()->id); 
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
