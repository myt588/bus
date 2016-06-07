<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metas extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'metas';
    
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['key', 'value', 'user_id'];

    /**
     * search meta by key
     *
     * @return void
     * @author 
     **/
    public function scopeByKey($query, $key)
    {
        return $query->where('key', '=', $key);
    }

    /**
     * Create or Update a meta value
     *
     * @return void
     * @author ME
     **/
    public static function createOrUpdate($key, $value)
    {
        if (Metas::byKey($key)->count()==0)
        {
            $meta = new static;
            $meta->key = $key;
            $meta->value = $value;
            $meta->save();
        } else {
            $meta = $this->byKey($key)->first();
            $meta->value = $value;
            $meta->save();
        }
    }
}
