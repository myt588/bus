<?php 

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model{

	//
    protected $fillable = ['imageable_id', 'imageable_type', 'title', 'url', 'thumbnail_url'];

    protected $baseDir = 'image/buses';

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Static function to create a photo instance
     *
     * @param $file, $owner_id, $owner_type
     * @return $photo
     **/
    public static function fromForm(UploadedFile $file, $id, $type)
    {
    	$photo = new static;
    	$name = time() . '-' . $file->getClientOriginalName();
    	$photo->url 	   	       = $photo->baseDir . '/' . $name;
    	$photo->imageable_type 	   = $type;
    	$photo->imageable_id 	   = $id;
        $photo->thumbnail_url      = $photo->baseDir . '/' . 'tn-' . $name;
        $file->move($photo->baseDir, $name);
        Image::make($photo->url)->fit(270, 160)->save($photo->thumbnail_url);
        return $photo;
    }

}
