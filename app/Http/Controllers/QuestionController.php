<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Question;

use Config;
use Auth;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAsk()
    {
        return view('question.ask');
    }

    public function ask()
    {
    	$question = new Question;

    	$question->title = Input::get('title');

    	$question->slug = str_slug($question->title, '-');
    	
    	$question->content = Input::get('content');

    	$question->status = Config::get('constants.QUESTION_STATUS.ACTIVE');

    	if (!is_null(Input::get('tag'))) {
    		$question->tag = strtolower(Input::get('tag'));
    	}

    	$question->created_by = Auth::user()->id;
    	$question->save();

    	$question_url = Config::get('constants.QUESTION_URL') . '/' . $question->id . '/' . $question->slug ;
    	
    	// redirect to question url
    	return redirect($question_url);
    }

    public function showQuestionDetail($id,$slug) {
    	var_dump($id);

    	$currentUserId = 0;

    	if(Auth::user()){
        	$currentUserId = Auth::user()->id;
        	$isPermissionApprove = Auth::user()->hasRole('teacher');
      	}

      	$question = Question::find($id);
     	
     	if($question){
        	$question->views_count += 1;
        	$question->save();
      	}
    }
}
