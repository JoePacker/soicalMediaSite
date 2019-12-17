<?php

use App\Permission;
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

        $adminRole->givePermissionTo('manage_users');
        $adminRole->givePermissionTo('delete_any_user');
        $adminRole->givePermissionTo('assign_role');
        $adminRole->givePermissionTo('revoke_role');
        $adminRole->givePermissionTo('assign_permission');
        $adminRole->givePermissionTo('revoke_permission');

        $moderatorRole = new Role;
        $moderatorRole->name = 'moderator';
        $moderatorRole->label = 'Moderator';
        $moderatorRole->save();

        $moderatorRole->givePermissionTo('edit_any_post');
        $moderatorRole->givePermissionTo('delete_any_post');
        $moderatorRole->givePermissionTo('edit_any_profile');

        $memberRole = new Role;
        $memberRole->name = 'member';
        $memberRole->label = 'Member';
        $memberRole->save();

        $memberRole->givePermissionTo('create_post');
        $memberRole->givePermissionTo('edit_own_post');
        $memberRole->givePermissionTo('delete_own_post');
        $memberRole->givePermissionTo('create_comment');
        $memberRole->givePermissionTo('edit_own_comment');
        $memberRole->givePermissionTo('delete_own_comment');
        $memberRole->givePermissionTo('edit_own_profile');
    }
}
