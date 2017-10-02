<?php

use Illuminate\Database\Seeder;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
	        [
	            'content' => 'First answer',
	            'question_id' => 1,
	            'answer_id' => 0,
	            'created_by' => 1,
	            'status' => 1,
	            'created_at' => date("Y-m-d H:i:s"),
	            'updated_at' => date("Y-m-d H:i:s")
	        ]
	    	, [
	            'content' => 'Second answer',
	            'question_id' => 1,
	            'answer_id' => 0,
	            'created_by' => 2,
	            'status' => 1,
	            'created_at' => date("Y-m-d H:i:s"),
	            'updated_at' => date("Y-m-d H:i:s")
	        ]
	        , [
	            'content' => 'Child answer 1',
	            'question_id' => 0,
	            'answer_id' => 1,
	            'created_by' => 2,
	            'status' => 1,
	            'created_at' => date("Y-m-d H:i:s"),
	            'updated_at' => date("Y-m-d H:i:s")
	        ]
	        , [
	            'content' => 'Child answer 2',
	            'question_id' => 0,
	            'answer_id' => 1,
	            'created_by' => 2,
	            'status' => 1,
	            'created_at' => date("Y-m-d H:i:s"),
	            'updated_at' => date("Y-m-d H:i:s")
	        ] 
    	]);
    }
}
