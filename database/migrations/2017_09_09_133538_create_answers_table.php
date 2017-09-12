<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('answer_id');
            $table->integer('question_id');
            $table->integer('up_vote')->default(0);
            $table->integer('down_vote')->default(0);
            $table->integer('edited_by')->nullable();
            $table->string('created_by');
            $table->integer('status')->comment('0 => deleted, 1 => active');            
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
        Schema::dropIfExists('answers');
    }
}
