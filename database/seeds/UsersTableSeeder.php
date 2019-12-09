<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Joe Packer';
        $user->email = 'joepacker@email.com';
        $user->password = bcrypt('password');
        $user->api_token = 'WagE56qgvepwm592l8vAxvKdYY13FnDVKIDRlpEwJM9zFOsf32yj4V6dFu0kgMrKegPshmLVA462NR2d';
        $user->save();

        $user->assignRole('admin');

        factory(User::class, 5)->create()->each(function ($user) {
            $user->assignRole('member');

            if ($user->id % 5 == 0) {
                $user->assignRole('moderator');
            }
        });
    }
}
