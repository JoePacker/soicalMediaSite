<?php

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
        factory(App\Post::class, 15)->create([
            'user_id' => function () {
                return User::all()->random()->id;
            }
        ]);
    }
}
