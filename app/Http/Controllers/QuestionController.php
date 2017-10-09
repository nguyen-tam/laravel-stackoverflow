<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Question;
use App\Answer;
use App\UserVotes;
use Carbon;

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
    	
    	return redirect($question_url);
    }

    public function answer()
    {
      
      $question = Question::find(Input::get("question_id"));

      $answer = new Answer;
      $answer->content = Input::get("answer");
      $answer->question_id = $question->id;
      $answer->answer_id = 0;
      $answer->status = 1;
      $answer->created_by = Auth::user()->id;
      $answer->save();

      $question_url = Config::get('constants.QUESTION_URL') . '/' . $question->id . '/' . $question->slug ;
      
      return redirect($question_url);
    }

    public function comment()
    {
      
      $answer_id = Input::get("answer_id");

      $answer = new Answer;
      $answer->content = Input::get("content");
      $answer->question_id = 0;
      $answer->answer_id = $answer_id;
      $answer->status = 1;
      $answer->created_by = Auth::user()->id;
      $answer->save();
      
      return Response::json(['status' => true, 'answer' => $answer]);

    }

    public function getQuestionById($id)
    {
        $question = Question::find($id);
        $question->asked_user = ($question->user)['name'];
        $question->asked_user_id = ($question->user)['id'];
        $question->tags = explode(',', $question->tag) ;
        $question->asked_user_avatar = '/uploads/avatars/'. ($question->user)['avatar'];

        if (Auth::user()) {
          $question->up_voted = $this->findUserVoteByType($id, Config::get('constants.VOTE_CATEGORY.QUESTION'), Config::get('constants.VOTE_TYPE.UP_VOTE'));
          $question->down_voted = $this->findUserVoteByType($id, Config::get('constants.VOTE_CATEGORY.QUESTION'), Config::get('constants.VOTE_TYPE.DOWN_VOTE'));  
        } else {
          $question->up_voted = false;
          $question->down_voted = false;
        }

        $question->formatted_created_at = $question->created_at->format('M-d-Y') . ' at ' . $question->created_at->format('h:i');
        
        $question->votes = $this->countUpVoteByUserAndVoteId($id, ($question->user)['id'], Config::get('constants.VOTE_CATEGORY.QUESTION') )
                           - $this->countDownVoteByUserAndVoteId($id, ($question->user)['id'], Config::get('constants.VOTE_CATEGORY.QUESTION') );
        return Response::json($question);
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

      foreach ($answers as $key => $answer) {

        if (Auth::user()) {
          $answers[$key]->up_voted = $this->findUserVoteByType($answer->id, Config::get('constants.VOTE_CATEGORY.ANSWER'), Config::get('constants.VOTE_TYPE.UP_VOTE'));
          $answers[$key]->down_voted = $this->findUserVoteByType($answer->id, Config::get('constants.VOTE_CATEGORY.ANSWER'), Config::get('constants.VOTE_TYPE.DOWN_VOTE'));
        } else {
          $answers[$key]->up_voted = false;
          $answers[$key]->down_voted = false;
        }

        $answers[$key]->formatted_created_at = $answers[$key]->created_at->format('M-d-Y') . ' at ' . $answers[$key]->created_at->format('h:i');

        $answers[$key]->votes = $this->countUpVoteByUserAndVoteId($answer->id, ($answer->user)['id'], Config::get('constants.VOTE_CATEGORY.ANSWER') )
                                - $this->countDownVoteByUserAndVoteId($answer->id, ($answer->user)['id'], Config::get('constants.VOTE_CATEGORY.ANSWER') );  
      }
      

      return Response::json($answers);
    }

    public function showQuestionList() {

      $questions = Question::orderBy('created_at', 'desc')->paginate(10);

      $newest_questions = Question::orderBy('created_at', 'desc')->paginate(20);

      $question_count = Question::count();

      return view('question.list', ['questions' => $questions, 'newest_questions' => $newest_questions
                                    ,'question_count' => $question_count ]);
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

    protected function findUserVote($vote_id, $vote_category ) {
      $user_vote = UserVotes::where('vote_id', $vote_id)
              ->where('vote_by', Auth::user()->id)
              ->where('vote_category', $vote_category) // 0 question, 1 answer
              // ->where('vote_type', $vote_type)    // 0 vote, 1 downvote
              ->first();
      return $user_vote;
    }

    protected function findUserVoteByType($vote_id, $vote_category, $vote_type) {            

      $user_vote = UserVotes::where('vote_id', $vote_id)
              ->where('vote_by', Auth::user()->id)
              ->where('vote_category', $vote_category)
              ->where('vote_type', $vote_type)
              ->exists();
      return $user_vote;
    }

    protected function countUpVoteByUserAndVoteId($vote_id, $user_id, $vote_category ) {
      $up_vote = UserVotes::where('vote_id', $vote_id)
              // ->where('vote_by', $user_id)
              ->where('vote_type', Config::get('constants.VOTE_TYPE.UP_VOTE')) 
              ->where('vote_category', $vote_category)              
              ->count();
      return $up_vote;
    }

    protected function countDownVoteByUserAndVoteId($vote_id, $user_id, $vote_category ) {
      $up_vote = UserVotes::where('vote_id', $vote_id)
              // ->where('vote_by', $user_id)
              ->where('vote_type', Config::get('constants.VOTE_TYPE.DOWN_VOTE'))   
              ->where('vote_category', $vote_category)           
              ->count();
      return $up_vote;
    }

    protected function undoVoted($user_voted) {
      $user_voted->delete();
    }    

    protected function insertUserVote($vote_id, $vote_category, $vote_type) {
      
      $new_vote = new UserVotes;
      $new_vote->created_at = Carbon::now();
      $new_vote->vote_by = Auth::user()->id;
      $new_vote->vote_id = $vote_id;
      $new_vote->vote_category = $vote_category;
      $new_vote->vote_type = $vote_type;
      $new_vote->save();
      
    }

    public function voteAction() {

      $vote_id = Input::get('vote_id');
      $vote_type = Input::get('vote_type');
      $vote_category = Input::get('vote_category');      


      $user_voted = $this->findUserVote($vote_id, $vote_category);

      if($user_voted){

        $isUndoVoted = $user_voted->vote_type == $vote_type;

        if ($isUndoVoted) {
          $this->undoVoted($user_voted);
        } else {
          $this->undoVoted($user_voted);
          $this->insertUserVote($vote_id, $vote_category, $vote_type);
        }

      } else {
        $this->insertUserVote($vote_id, $vote_category, $vote_type);
      }

      $up_votes = $this->countUpVoteByUserAndVoteId($vote_id,Auth::user()->id, $vote_category);
      $down_votes = $this->countDownVoteByUserAndVoteId($vote_id,Auth::user()->id, $vote_category);

      $votes = $up_votes - $down_votes;
      $up_voted = $this->findUserVoteByType($vote_id, $vote_category, Config::get('constants.VOTE_TYPE.UP_VOTE'));
      $down_voted = $this->findUserVoteByType($vote_id, $vote_category, Config::get('constants.VOTE_TYPE.DOWN_VOTE'));

      return Response::json(['status' => true, 'votes' => $votes, 'up_voted' => $up_voted, 'down_voted' => $down_voted
                           ]);
    }
}
