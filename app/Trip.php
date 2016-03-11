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
    public function tickets()
    {
        return $this->belongsToMany('App\Ticket');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function stations()
    {
        return $this->belongsToMany('App\Station')->withPivot('time');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function company()
    {
        return $this->belongsTo('App\Companies');
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

}
