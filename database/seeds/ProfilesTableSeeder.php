<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Profile;
        $profile->user_id = 1;
        $profile->bio = 'This is my biography where I talk about myself and all of my interests.';
        $profile->image = 'https://lorempixel.com/64/64/?12345';
        $profile->save();

        User::all()->except($profile->user_id)->each(function ($user) {
            factory(Profile::class)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
