<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station extends Model
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
    protected $table = 'stations';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'city_id', 'name', 'address', 'lat', 'lng'];
 
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
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function trips()
    {
        return $this->belongsToMany('App\Trip')->withPivot('time', 'departure');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function ticketsDepart()
    {
        return $this->hasMany('App\Tickets', 'depart_station');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function ticketsArrive()
    {
        return $this->hasMany('App\Tickets', 'arrive_station');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function photos()
    {
        return $this->morphToMany('App\Photo', 'imageable');
    }

    public function stationTime() 
    {
        return date('h:i a', strtotime($this->pivot->time));
    }

    public function fullAddress()
    {
        return $this->address . ', ' . $this->city->city . ', ' . $this->city->state;
    }

    /**
     * Check if there is trip linked to this station
     *
     * @return Boolean
     */
    public function getLinkedItems()
    {
        if ($this->trips->count() != 0)
        {
            return true;
        } 
        return false;
    }
}
