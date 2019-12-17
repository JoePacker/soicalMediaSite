<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'city' => $faker->city,
        'image' => 'https://picsum.photos/id/' . $faker->numberBetween(1051, 1080) . '/720/480',
        'body' => $faker->text(1000),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
