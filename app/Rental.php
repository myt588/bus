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
    protected $fillable = ['company_id', 'bus_id', 'transaction_id', 'description', 'one_day', 'three_days', 'one_week'];


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

}
