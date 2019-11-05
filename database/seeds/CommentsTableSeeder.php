<?php

use App\Comment;
use App\Post;
use App\User;
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
        $comment = new Comment;
        $comment->user_id = 1;
        $comment->post_id = 1;
        $comment->body = 'This is the body of my comment.';
        $comment->save();

        factory(Comment::class, 50)->create([
            'user_id' => function () {
                return User::all()->random()->id;
            },
            'post_id' => function () {
                return Post::all()->random()->id;
            },
        ]);
    }
}
