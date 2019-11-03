<?php

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
        User::all()->each(function ($user) {
            factory(App\Profile::class)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
