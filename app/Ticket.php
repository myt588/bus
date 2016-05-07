<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
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
    protected $table = 'tickets';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'trip_id', 'transaction_id', 'description', 'depart_date', 'depart_station', 'arrive_station'];


    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function departStation()
    {
        return $this->belongsTo('App\Station', 'depart_station');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function arriveStation()
    {
        return $this->belongsTo('App\Station', 'arrive_station');
    }


    public function firstName() 
    {
        return $this->user->first_name;
    }

    public function lastName() 
    {
        return $this->user->last_name;
    }

    public function email() 
    {
        return $this->user->email;
    }

    public function isPast()
    {
        $date = $this->depart_date . ' ' . $this->trip->depart_at;
        return (strtotime($date) < time());
    }

}
