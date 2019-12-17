<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->user_id = 1;
        $post->title = 'This is an awesome post';
        $post->city = 'Swansea';
        $post->image = 'https://picsum.photos/id/1051/720/480';
        $post->body = 'This is the body of my post. It contains all the information about the post and should be read by everyone.';
        $post->save();

        factory(Post::class, 15)->create([
            'user_id' => function () {
                return User::all()->random()->id;
            },
        ]);
    }
}
