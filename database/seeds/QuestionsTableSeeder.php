<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('questions')->insert([

            [
                'title' => 'Why this program doesnt run ?',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel velit lorem. Vivamus ut dictum magna, venenatis blandit sem. Donec porttitor porttitor purus ut placerat. Donec dapibus consequat sem, a consequat magna. Morbi tincidunt quam ut mauris suscipit, sed volutpat enim vehicula. Aenean iaculis ligula at orci euismod porta. Maecenas iaculis fringilla orci, ac feugiat odio lacinia quis. Vivamus ornare vestibulum nisi, vel lacinia metus consectetur id. Integer sit amet felis maximus, feugiat augue a, tempus risus. Quisque nisi erat, gravida nec rhoncus quis, gravida ac metus. Aenean venenatis urna a mauris accumsan efficitur finibus tincidunt ante.

    Morbi eu mollis ligula. Duis iaculis lobortis vestibulum. Vestibulum viverra maximus malesuada. Vivamus diam lorem, sagittis a diam vel, rhoncus condimentum nisi. Nunc non magna vel massa iaculis ultricies. Suspendisse faucibus feugiat interdum. Nulla placerat imperdiet ex lacinia posuere.',

                'slug' => 'why-this-program-doesnt-run',
                'status' => 1,
                'created_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'title' => 'Failed to sign APK package.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel velit lorem. Vivamus ut dictum magna, venenatis blandit sem. Donec porttitor porttitor purus ut placerat. Donec dapibus consequat sem, a consequat magna. Morbi tincidunt quam ut mauris suscipit, sed volutpat enim vehicula. Aenean iaculis ligula at orci euismod porta. Maecenas iaculis fringilla orci, ac feugiat odio lacinia quis. Vivamus ornare vestibulum nisi, vel lacinia metus consectetur id. Integer sit amet felis maximus, feugiat augue a, tempus risus. Quisque nisi erat, gravida nec rhoncus quis, gravida ac metus. Aenean venenatis urna a mauris accumsan efficitur finibus tincidunt ante. Morbi eu mollis ligula. Duis iaculis lobortis vestibulum. Vestibulum viverra maximus malesuada. Vivamus diam lorem, sagittis a diam vel, rhoncus condimentum nisi. Nunc non magna vel massa iaculis ultricies. Suspendisse faucibus feugiat interdum. Nulla placerat imperdiet ex lacinia posuere.',

                'slug' => 'failed-to-sign-apk',
                'status' => 1,
                'created_by' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'title' => 'Image not loading in the template',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel velit lorem. Vivamus ut dictum magna, venenatis blandit sem. Donec porttitor porttitor purus ut placerat. Donec dapibus consequat sem, a consequat magna. Morbi tincidunt quam ut mauris suscipit, sed volutpat enim vehicula. Aenean iaculis ligula at orci euismod porta. Maecenas iaculis fringilla orci, ac feugiat odio lacinia quis. Vivamus ornare vestibulum nisi, vel lacinia metus consectetur id. Integer sit amet felis maximus, feugiat augue a, tempus risus. Quisque nisi erat, gravida nec rhoncus quis, gravida ac metus. Aenean venenatis urna a mauris accumsan efficitur finibus tincidunt ante. Morbi eu mollis ligula. Duis iaculis lobortis vestibulum. Vestibulum viverra maximus malesuada. Vivamus diam lorem, sagittis a diam vel, rhoncus condimentum nisi. Nunc non magna vel massa iaculis ultricies. Suspendisse faucibus feugiat interdum. Nulla placerat imperdiet ex lacinia posuere.',

                'slug' => 'image-not-loading-in-the-template',
                'status' => 1,
                'created_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]            
        ]);
    }
}
