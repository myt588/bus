<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rentals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 
        'bus_id', 
        'transaction_id', 
        'description', 
        'per_day', 
        'per_hour', 
        'per_week'
        ];

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function bus()
    {
        return $this->belongsTo('App\Bus');
    }

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
    public function rents()
    {
        return $this->hasMany('App\Rent');
    }
    
    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }

    /**
     * set the active state of the Rental
     *
     * @return void
     * @author Boolean
     **/
    public function setActiveState()
    {
        $this->active = $this->active ? false : true;
        $this->save();
        return $this->active;
    }

}
