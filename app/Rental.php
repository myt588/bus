<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rentals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 
        'bus_id', 
        'transaction_id', 
        'description', 
        'per_day', 
        'per_hour', 
        'per_week'
        ];

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
    public function company()
    {
        return $this->belongsTo('App\Company');
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
     * set the active state of the Rental
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

    /**
     * Scope by seat number of the bus
     *
     * @return query
     * @author ME
     **/
    public function scopeBySeats($query, $size)
    {
        return $query->whereHas('bus', function ($query) use ($size) {
            $query->where('seats', '>=', $size);
        });
    }

    /**
     * Scope by type of the bus
     *
     * @return query
     * @author ME
     **/
    public function scopeTypeFilter($query, $type)
    {
        return $query->whereHas('bus', function ($query) use ($type) {
            $query->where('type', '=', $type);
        });
    }

    /**
     * scope a filter by price
     *
     * @return $trips
     * @author Me
     **/
    public function scopePriceFilter($query, $min, $max)
    {
        return $query->whereBetween('per_day', [$min, $max]);
    }

    /**
     * scope a filter by company name 
     *
     * @return $query
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
     * scope a filter by bus type
     *
     * @return $query
     * @author Me
     **/
    public function scopeMultiTypeFilter($query, $names)
    {
        if ($names == [])
        {
            return $query;
        }
        return $query->whereHas('bus', function ($query) use ($names) {
            $query->whereIn('type', $names);
        });
    }

    /**
     * get the count of each type
     *
     * @return int
     * @author me
     **/
    public function typeCount($rentals, $type)
    {   
        return 0;
    }

}
