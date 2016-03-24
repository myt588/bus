<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';
    
    /**
     * DB Relation Function
     *
     * @return void
     **/
	public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }
}
