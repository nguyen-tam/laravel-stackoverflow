<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            
            [
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'password' => bcrypt('111111')
            ]
            , [
                'name' => 'Joe Doe',
                'email' => 'joedoe@gmail.com',
                'password' => bcrypt('111111')
            ]
        ]);
    }
}
