<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
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
	protected $table = 'companies';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'year_founded', 'rating', 'verified', 'code', 'base'];

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
    public function buses()
    {
        return $this->hasMany('App\Bus');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function trips()
    {
        return $this->hasMany('App\Trip');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function stations()
    {
        return $this->hasMany('App\Station');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function fares()
    {
        return $this->hasMany('App\Fare');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function rentals()
    {
        return $this->hasMany('App\Rental');
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
     * get company item by company name
     *
     * @return this
     * @author me
     **/
    public function scopeByName($query, $name)
    {
        return $query->where('name', '=', $name)->get();
    }

    public function ticketsCount()
    {
        $count = 0;
        foreach($this->trips as $trip)
        {
            $count += $trip->tickets->count();
        }
        return $count;
    }

    public function sales()
    {
        $sales = 0;
        foreach($this->trips as $trip)
        {
            $sales += $trip->tickets->count() * $trip->fee;
        }
        return $sales;
    }

    public function tripsBetweenDates($start, $end)
    {
        $datediff = abs(strtotime($end) - strtotime($start));
        $dayCount = floor($datediff/(60*60*24));
        $trips = collect([]);
        for ($i = 0; $i <= $dayCount; $i++)
        {
            $trips->push($this->trips()->where('weekdays', '&', stringToWeekday($start . '+ ' . $i . ' days'))->get());
        }
        return $trips;
    }

}
