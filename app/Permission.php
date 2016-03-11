<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
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
