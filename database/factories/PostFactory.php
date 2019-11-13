<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'image' => $faker->imageUrl(720, 480),
        'body' => $faker->text(1000),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
