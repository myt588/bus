<?php 

namespace App\Helpers;

/**
 * Created by PhpStorm.
 * User: Tian
 * Date: 5/2/15
 * Time: 3:34 PM
 */


use App\Photo;

class PhotoService {

    protected $photos;

    function __construct(Photo $photos)
    {
        $this->photos = $photos;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return photo $photos
     */
    public function getById($id)
    {
        return $this->photos->findOrFail($id);
    }

    /**
     * get photo by photo name
     *
     * @param  String $name
     * @return photo $photos
     */
    public function getByName($name)
    {
        return $this->photos->where('title', $name)->first();
    }

    /**
     * get all photos
     *
     * @return photo $photos
     */
    public function getAll()
    {
        return $this->photos->all();
    }

    /**
     * get photos by Pagination.
     *
     * @return photo $photos
     */
    public function getByPagination($perPage)
    {
        return $this->photos->paginate($perPage);
    }

    /**
     * function savePhotoTo
     *
     * @param File $file
     * @return String
     */
    private function savePhotoTo($file)
    {
        $filename = $file->getClientOriginalName();
        $filename = '/image/' . time() . '-' . $filename;
        $file->move(public_path() . '/image', $filename);
        return $filename;
    }

    /**
     * function create
     *
     * @param File $file
     * @param Array $data
     * @return Photo
     */
    public function create($file, $data){
        $filename = $this->savePhotoTo($file);
        $data = array_add($data, 'url', $filename);
        return $this->photos->create($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param int  $id
     * @param File $file
     * @param Array $data
     * @return photo $photo
     */
    public function update($id, $file, $data)
    {
        $photo = $this->photos->findOrFail($id);
        $filename = $this->savePhotoTo($file);
        array_add($data, 'url', $filename);
        $photo->update($data);
        return $photo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $photo = $this->photos->findOrFail($id);
        $photo->delete();
    }

}