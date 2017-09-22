<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vote', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vote_category')->comment('0 - question, 1 - answer, 2 - comment');;
            $table->integer('vote_type')->comment('1 - upvote, 0 - downvote');;
            $table->integer('vote_id');
            $table->integer('vote_by');         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_vote');
    }
}
