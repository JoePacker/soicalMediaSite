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
        $user->role_id = 1;
        $user->name = 'Joe Packer';
        $user->email = 'joepacker@email.com';
        $user->password = bcrypt('password');
        $user->save();

        factory(User::class, 5)->create([
            'role_id' => function () {
                return Role::where('name', 'member')->first()->id;
            },
        ]);
    }
}
