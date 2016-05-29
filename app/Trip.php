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
    protected $fillable = [
        'company_id', 
        'from', 
        'to', 
        'bus_id', 
        'rating', 
        'depart_at', 
        'arrive_at', 
        'name', 
        'price', 
        'fee',
        'discount', 
        'weekdays'
        ];
    
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
     * DB Relation Function
     *
     * @return void
     **/
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }

    /**
     * get Company Name
     *
     * @return string
     **/
    public function companyName()
    {
        return $this->company->name;
    }

    /**
     * get the total time it takes for the trip
     *
     * @return time in H:i
     **/
    public function totalTime()
    {
        return date('h:i', strtotime($this->arrive_at) - strtotime($this->depart_at));
    }

    /**
     * get subname for the trip
     *
     * @return string
     **/
    public function subname()
    {
        return 'Depart: ' . $this->depart_at . ' & Arrive: ' . $this->arrive_at;
    }

    /**
     * scope a search query on the trips
     *
     * @return $trips
     * @author Me
     **/
    public function scopeSearch($query, $from, $to, $weekdays)
    {
        return $query->where('from', '=', $from)
                     ->where('to', '=', $to)
                     ->where('weekdays', '&', $weekdays)
                     ->where('active', '=', 1);
    }

    /**
     * scope a filter by price
     *
     * @return $trips
     * @author Me
     **/
    public function scopePriceFilter($query, $min, $max)
    {
        return $query->whereBetween('fee', [$min, $max]);
    }

    /**
     * scope a filter by depart time
     *
     * @return $trips
     * @author Me
     **/
    public function scopeDepartFilter($query, $start, $end)
    {
        if ($start == "12:00 AM" && $start == $end)
        {
            $end = "11:59 PM";
        }
        return $query->whereBetween('start', [date("H:i:s", strtotime($start)), date("H:i:s", strtotime($end))]);
    }

     /**
     * scope a filter by depart time
     *
     * @return $trips
     * @author Me
     **/
    public function scopeCompanyFilter($query, $names)
    {
        if ($names == ["all"])
        {
            return $query;
        }
        $company_ids = [];
        foreach($names as $i => $name)
        {
            $company = Company::byName($name);
            if (count($company) > 0)
            {
                $company_ids[$i] = $company->first()->id;
            }
        }
        return $query->whereIn('company_id', $company_ids);
    }

    /**
     * Number of tickets booked for this trip on $date
     *
     * @param Date $date
     * @return Int
     **/
    public function ticketsBookedCountOn($date)
    {
        return $this->tickets()->where('depart_date', '=', $date)->count();
    }

    /**
     * Number of tickets sold for this trip on $date
     *
     * @param Date $date
     * @return Int
     **/
    public function ticketsSoldCountOn($date)
    {
        return $this->tickets()->whereDate('created_at', '=', $date)->count();
    }

    /**
     * Check if the trip on this $date is available
     *
     * @param Date $date
     * @return Bool
     **/
    public function isAvailable($date)
    {
        return $this->weekdays & stringToWeekday($date);
    }

    /**
     * get Dates available between $start and $end
     *
     * @param Date $start, $end
     * @return String $dates
     **/
    public function availableDatesBetween($start, $end)
    {
        $datediff = abs(strtotime($end) - strtotime($start));
        $dayCount = floor($datediff/(60*60*24));
        $dates = collect([]);
        for ($i = 0; $i <= $dayCount; $i++)
        {
            $date = $start . '+ ' . $i . ' days';
            if ($this->isAvailable($date))
            {
                $dates->push(stringToDate($date));
            }
        }
        return $dates;
    }

    /**
     * Handling the many to many relationship between stations and trips
     *
     * @param Station $stops, $times, Boolean $departure
     * @return void
     * @author 
     */
    public function stationHandler($stops, $times, $departure)
    {
        for ($i=0; $i<count($stops); $i++) {
            $this->stations()
                 ->attach($stops[$i], ['time' => $times[$i], 'departure' => $departure]);
        }
    }

    /**
     * Get all the stations belong to one trip, organize them into two collections
     *
     * @param none
     * @return void
     * @author 
     */
    public function getStationsPivotData(&$depart_stops, &$arrive_stops)
    {
        $depart_stops = collect([]);
        $arrive_stops = collect([]);
        foreach ($this->stations as $item)
        {
            if($item->pivot->departure)
            {
                $depart_stops->push(['stop' => $item->id, 'time' => $item->pivot->time]);
            } else {
                $arrive_stops->push(['stop' => $item->id, 'time' => $item->pivot->time]);
            }
        }
    }

    /**
     * check whether the trip is running overnight
     *
     * @return void
     * @author 
     **/
    public function checkTimeIsOvernight()
    {
        return (str_contains($this->depart_at, 'PM') && str_contains($this->arrive_at, 'AM'));
    }

    /**
     * set the active state of the trip
     *
     * @return void
     * @author Boolean
     **/
    public function setActiveState()
    {
        $this->active = $this->active ? false : true;
        $this->save();
        return $this->active;
    }

}
