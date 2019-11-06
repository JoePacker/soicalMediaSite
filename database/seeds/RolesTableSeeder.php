<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->label = 'Administrator';
        $adminRole->save();

        $memberRole = new Role;
        $memberRole->name = 'member';
        $memberRole->label = 'Member';
        $memberRole->save();
    }
}
