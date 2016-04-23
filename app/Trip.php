<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Trip extends Model
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
    protected $table = 'trips';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'from', 'to', 'bus_id', 'rating', 'depart_at', 'arrive_at', 'name', 'price', 'discount', 'weekdays'];
    
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
    public function fares()
    {
        return $this->belongsToMany('App\Fare');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function stations()
    {
        return $this->belongsToMany('App\Station')->withPivot('time', 'departure');
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
    public function bus()
    {
        return $this->belongsTo('App\Bus');
    }

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
    public function fromCity()
    {
        return $this->belongsTo('App\City', 'from');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function toCity()
    {
        return $this->belongsTo('App\City', 'to');
    }

    /**
     * get Company Name
     *
     * @return void
     **/
    public function companyName()
    {
        return $this->company->name;
    }

    public function totalTime()
    {
        return date('h:i', strtotime($this->arrive_at) - strtotime($this->depart_at));
    }

    public function price()
    {
        return $this->price * $this->discount;
    }

    public function ticketsBookedCountOn($date)
    {
        return $this->tickets()->where('depart_date', '=', $date)->count();
    }

    public function ticketsSoldCountOn($date)
    {
        return $this->tickets()->whereDate('created_at', '=', $date)->count();
    }

}
