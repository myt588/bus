<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function givePermissionTo(Permission $permission)
    {
    	return $this->permissions()->save($permission);
    }

}
