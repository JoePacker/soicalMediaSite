<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label',
    ];

    /**
     * Get the users for the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * The permissions that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    /**
     * todo: add comment.
     */
    public function givePermissionTo($permission)
    {
        return $this->permissions()->save(
            Permission::whereName($permission)->firstOrFail()
        );
    }
}
