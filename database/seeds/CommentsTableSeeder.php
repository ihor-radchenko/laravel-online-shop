<?php

use AutoKit\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'name' => 'KOKOC',
            'email' => 'kokoc@gmail.com',
            'user_id' => 1,
            'article_id' => 1,
            'text' => 'Hello world'
        ]);
        Comment::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'article_id' => 1,
            'text' => 'Lorem ipsum dolor sit'
        ]);
    }
}
