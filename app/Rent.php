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
    protected $fillable = ['user_id', 'rental_id', 'transaction_id', 'description', 'start', 'end', 'passengers'];


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

    /**
     * Check if the rent is already over
     *
     * @return Boolean
     **/
    public function isPast()
    {
        $date = $this->start;
        return (strtotime($date) < time());
    }

    /**
     * get the name, combine bus make model type, start, end date
     *
     * @return string
     * @author 
     **/
    public function getName()
    {
        $bus = $this->rental->bus;
        return $bus->type. ' '. $bus->getMakeModel(). ' from '. $this->start. ' to '. $this->end;
    }

    /**
     * scope filter by date
     *
     * @return query
     * @author 
     **/
    public function scopeUpcoming($query)
    {
        return $query->where('start', '>=', time());
    }

    /**
     * scope filter by date
     *
     * @return query
     * @author 
     **/
    public function scopeCancelled($query)
    {
        return $query->where('start', '>', time());
    }

     /**
     * Scope by company
     *
     * @return query
     * @author ME
     **/
    public function scopeByCompany($query, $id)
    {
        if ($id == null) { return $query; }
        return $query->whereHas('rental', function ($query) use ($id) {
            $query->where('company_id', '=', $id);
        });
    }
}
