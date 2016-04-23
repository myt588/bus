<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['confirmation_number', 'quantity', 'description'];


     /**
     * DB Relation Function
     *
     * @return void
     **/
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
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
