<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cities';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['city', 'state', 'zipcode'];

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function stations()
    {
        return $this->hasMany('App\Station');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function trips()
    {
        return $this->hasMany('App\Trip');
    }
}
