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
        return $this->hasMany('App\User');
    }

    /**
     * The permissions that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
}
