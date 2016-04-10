<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fare extends Model
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
    protected $table = 'fares';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'price', 'discount', 'final_price'];

     /**
     * DB Relation Function
     *
     * @return void
     **/
    public function trips()
    {
        return $this->belongsToMany('App\Trip');
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
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

}
