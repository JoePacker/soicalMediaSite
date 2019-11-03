<?php

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
        factory(App\Comment::class, 50)->create([
            'user_id' => function () {
                return User::all()->random()->id;
            },
            'post_id' => function () {
                return Post::all()->random()->id;
            },
        ]);
    }
}
