<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'companies';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'year_founded', 'rating', 'verified', 'code'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
     * DB Relation Function
     *
     * @return void
     **/
    public function buses()
    {
        return $this->hasMany('App\Bus');
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
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function fares()
    {
        return $this->hasMany('App\Fare');
    }

}
