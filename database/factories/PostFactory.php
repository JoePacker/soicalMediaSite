<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(30),
        'city' => $faker->randomElement(['London', 'Edinburgh', 'Dublin', 'Sydney', 'Oslo', 'Paris', 'Auckland', 'Barcelona']),
        'image' => 'https://picsum.photos/seed/' . $faker->randomNumber(5) . '/720/480',
        'body' => $faker->realText(1000),
        'created_at' => $faker->dateTimeBetween('-3 months', '-2 months')->format('Y-m-d H:i:s'),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
