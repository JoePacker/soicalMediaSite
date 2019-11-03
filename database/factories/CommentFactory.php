<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->text(300),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'post_id' => function () {
            return factory(App\Post::class)->create()->id;
        },
    ];
});
