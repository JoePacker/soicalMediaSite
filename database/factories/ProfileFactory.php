<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'image' => 'https://picsum.photos/id/' . $faker->numberBetween(151, 200) . '/128',
        'bio' => $faker->text(300),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
