<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    protected $fillable = ['company_id', 'from', 'to', 'rating', 'depart_at', 'arrive_at', 'name'];
    
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
    public function buses()
    {
        return $this->belongsToMany('App\Bus');
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
        return date('h:i', strtotime($this->arrive_at - $this->depart_at));
    }

    public function farePrice()
    {
        return $this->fares->first()->final_price;
    }


}
