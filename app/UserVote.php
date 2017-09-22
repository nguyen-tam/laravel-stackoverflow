<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVotes extends Model
{
	
    protected $table = 'user_vote';
    public $timestamps = false;
}
