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

class QuestionAPIController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function findUserVote($vote_id, $vote_category, $type ) {
      $user_vote = UserVotes::where('vote_id', $vote_id)
              ->where('vote_by', Auth::user()->id)
              ->where('vote_category', $vote_category) // 0 question, 1 answer
              ->where('vote_type', $type)    // 0 vote, 1 downvote
              ->first();
      return $user_vote;
    }

    protected function undoVoteIfVoted($vote_id, $vote_category, $type) {
      $user_vote = $this->findUserVote($vote_id, $vote_category, $type);

      if($user_vote){
        $user_vote->delete();
        return true;
      }

      return false;
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

    public function updateVote($vote_id, $vote_category, $type) {
      
      $isDownVoted = $this->undoVoteIfVoted($vote_id, $vote_category, $type);

      if (!$isDownVoted) {
        $this->insertUserVote($vote_id, $vote_category, $type);
      } 

    }

    public function voteQuestion() {

      $question_id = Input::get('question_id');
      $type = Input::get('type');
      $vote_category = Input::get('vote_category');      

      // TODO neu da upvote ma call downvote -> undo upvote -> call downvote
      $this->updateVote($question_id, $vote_category, $type);

      // TODO return so vote hien tai
      return Response::json(['status' => true]);
    }
}
