<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Bus extends Model
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
    protected $table = 'buses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 
        'license_plate', 
        'bus_number', 
        'vehicle_number', 
        'make', 
        'model', 
        'year', 
        'seats', 
        'type',
        'wifi', 
        'usb', 
        'toilet'
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * DB Relation Function
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trips()
    {
        return $this->hasMany('App\Trip');
    }

    /**
     * DB Relation Function
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rental()
    {
        return $this->hasOne('App\Rental');
    }

    /**
     * DB Relation Function
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }

    /**
     * Get the Features of the Bus
     *
     * @return String
     */
    public function features()
    {
        $features = '';
        if ($this->wifi)
        {
            $features = $features . 'wifi ';
        }
        if ($this->usb)
        {
            $features = $features . 'usb ';
        }
        if ($this->tiolet)
        {
            $features = $features . 'tiolet';
        }
        if ($features == '')
        {
            $features = 'No Feautres';
        }
        return $features;
    }

    /**
     * Get the make and model of the bus and make them into a string
     *
     * @return String
     */
    public function getMakeModel()
    {
        return $this->make . ' ' . $this->model;
    }

    /**
     * Check if there is rental or trip linked to this bus
     *
     * @return Boolean
     */
    public function getLinkedItems()
    {
        if ($this->trips->count() != 0 || $this->rental)
        {
            return true;
        } 
        return false;
    }

    /**
     * Get One Thumbnail url that is attached to this bus
     *
     * @return photo url
     * @author 
     **/
    public function getThumbnail()
    {
        if ($this->photos->count() > 0)
        {
            return $this->photos->first()->thumbnail_url;
        }
        return "image/defaults/no-image.png";
    }

    /**
     * Get One Photo url that is attached to this bus
     *
     * @return photo url
     * @author 
     **/
    public function getPhoto()
    {
        if ($this->photos->count() > 0)
        {
            return $this->photos->first()->url;
        }
        return "image/defaults/no-image.png";
    }

}
