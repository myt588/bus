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
    protected $fillable = ['user_id', 'fare_id', 'transaction_id', 'description'];


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
    public function fare()
    {
        return $this->hasOne('App\Fare');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function transaction()
    {
        return $this->hasOne('App\Transaction');
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

    // public function busNumber() 
    // {
    //     return $this->fare->trips->first->buses->first->
    // }

}
