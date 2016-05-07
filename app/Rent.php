<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rents';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'rental_id', 'transaction_id', 'description'];


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
    public function rental()
    {
        return $this->belongsTo('App\Rental');
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

    public function isPast()
    {
        $date = $this->depart_date;
        return (strtotime($date) < time());
    }
}
