<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Question;
use App\Answer;

use Config;
use Auth;
use Response;
class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

    public function getQuestionById($id)
    {
        $question = Question::find($id);
        $question->asked_user = ($question->user)['name'];
        return Response::json($question);
    }

    public function voteQuestion() {
        $question_id = Input::get('question_id');
        $type = Input::get('type');

        return Response::json($question_id);
    }

    public function getAnswersById($questionId){
        
      $answers = Answer::with(array('children'=>function($query){
                    $query
                    ->with(array('user'=>function($query1){
                                  $query1->select('*');
                              }))->select('*');
                }))
                ->with(array('user'=>function($query){
                              $query->select('*');
                          }))
                ->where('answers.question_id', $questionId)
                ->orderBy('answers.status', 'desc')
                ->orderBy('answers.created_at', 'desc')
                ->get();

      return Response::json($answers);
    }

    public function showQuestionDetail($id,$slug) {

    	$currentUserId = 0;

    	if(Auth::user()){
        	$currentUserId = Auth::user()->id;
      	}

      	$question = Question::find($id);
     	
     	if($question){
        	$question->views++;
        	$question->save();
      	}

        return view('question.detail', ['question' => $question,
                                        'currentUserId' => $currentUserId,
                                        'isLogin' => $currentUserId > 0]);
    }
}
