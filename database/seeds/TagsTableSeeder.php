<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //js,frontend

        DB::table('tags')->insert([
            
            [
                'name' => 'javascript',
                'question_id' => 1
            ]
            , [
                'name' => 'js',
                'question_id' => 1
            ]
            , [
                'name' => 'frontend',
                'question_id' => 1
            ]
            , [
                'name' => 'android',
                'question_id' => 2
            ]
            , [
                'name' => 'javascript',
                'question_id' => 3
            ]
            , [
                'name' => 'js',
                'question_id' => 3
            ]
        ]);

    }
}
