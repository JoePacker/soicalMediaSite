<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createPostPermission = new Permission();
        $createPostPermission->name = 'create_post';
        $createPostPermission->label = 'Create a post';
        $createPostPermission->save();

        $editOwnPostPermission = new Permission();
        $editOwnPostPermission->name = 'edit_own_post';
        $editOwnPostPermission->label = 'Edit own post';
        $editOwnPostPermission->save();

        $editAnyPostPermission = new Permission();
        $editAnyPostPermission->name = 'edit_any_post';
        $editAnyPostPermission->label = 'Edit any post';
        $editAnyPostPermission->save();

        $deleteOwnPostPermission = new Permission();
        $deleteOwnPostPermission->name = 'delete_own_post';
        $deleteOwnPostPermission->label = 'Delete own post';
        $deleteOwnPostPermission->save();

        $deleteAnyPostPermission = new Permission();
        $deleteAnyPostPermission->name = 'delete_any_post';
        $deleteAnyPostPermission->label = 'Delete any post';
        $deleteAnyPostPermission->save();

        $createCommentPermission = new Permission();
        $createCommentPermission->name = 'create_comment';
        $createCommentPermission->label = 'Create a comment';
        $createCommentPermission->save();

        $editOwnCommentPermission = new Permission();
        $editOwnCommentPermission->name = 'edit_own_comment';
        $editOwnCommentPermission->label = 'Edit own comment';
        $editOwnCommentPermission->save();

        $editAnyCommentPermission = new Permission();
        $editAnyCommentPermission->name = 'edit_any_comment';
        $editAnyCommentPermission->label = 'Edit any comment';
        $editAnyCommentPermission->save();

        $deleteOwnCommentPermission = new Permission();
        $deleteOwnCommentPermission->name = 'delete_own_comment';
        $deleteOwnCommentPermission->label = 'Delete own comment';
        $deleteOwnCommentPermission->save();

        $deleteAnyCommentPermission = new Permission();
        $deleteAnyCommentPermission->name = 'delete_any_comment';
        $deleteAnyCommentPermission->label = 'Delete any comment';
        $deleteAnyCommentPermission->save();

        $deleteUserPermission = new Permission();
        $deleteUserPermission->name = 'delete_user';
        $deleteUserPermission->label = 'Delete a user';
        $deleteUserPermission->save();

        $assignRolePermission = new Permission();
        $assignRolePermission->name = 'assign_role';
        $assignRolePermission->label = 'Assign a role';
        $assignRolePermission->save();

        $revokeRolePermission = new Permission();
        $revokeRolePermission->name = 'revoke_role';
        $revokeRolePermission->label = 'Revoke a role';
        $revokeRolePermission->save();

        $assignPermissionPermission = new Permission();
        $assignPermissionPermission->name = 'assign_permission';
        $assignPermissionPermission->label = 'Assign a permission';
        $assignPermissionPermission->save();

        $revokePermissionPermission = new Permission();
        $revokePermissionPermission->name = 'revoke_permission';
        $revokePermissionPermission->label = 'Revoke a permission';
        $revokePermissionPermission->save();
    }
}
