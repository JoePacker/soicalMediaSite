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
