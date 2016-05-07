<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model{

	//
    protected $fillable = ['owner_id', 'owner_type', 'title', 'url'];

    public function imageable()
    {
        return $this->morphTo();
    }

}
