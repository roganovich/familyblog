<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Uploader extends Model
{

    protected $attributes = ['_images'=>'','_object'=>'','_path'=>''];

    public function uploadload(){
        $i = 1;
        foreach ($this->files as $img) {

            $extension = $img->getClientOriginalExtension();
            $filename = md5($img->getRealPath()) .'.' . $extension ?: 'png';
            $filepath = $this->path  . $filename;

            $img->move(public_path().'/uploads/'.$this->path, $filename);

            $img = new Image();
            $img->title = $this->object->title;
            $img->obj_class = get_class($this->object);
            $img->obj_id = $this->object->id;
            $img->img_path = $filepath;
            $img->img_name = $filename;
            $img->level = $i++;

            $img->save();
        }
    }

    public function setImagesAttribute($files){
        $this->attributes['_images'] = $files;
    }

    public function getImagesAttribute(){
        //not work? i dont know why?
        /*if(!$this->attributes['_images']){
            $this->attributes['_images'] = request()->file('images');
        }*/
        return $this->attributes['_images'];
    }

    public function setObjectAttribute($object){
        $this->attributes['_object'] = $object;
    }

    public function getObjectAttribute(){
        return $this->attributes['_object'];
    }

    public function setPathAttribute($path = ''){
        $this->attributes['_path'] = $path;
    }

    public function getPathAttribute(){
        if(!$this->attributes['_path']){
            $this->attributes['_path'] = $this->generatePath();
        }
        return $this->attributes['_path'];
    }

    public function generatePath(){
        $pathObj = class_basename($this->object);
        $pathObjId =  $this->object->id;
        $path =  $pathObj. '/' . $pathObjId . '/';
        Storage::disk('uploads')->makeDirectory($pathObj);
        Storage::disk('uploads')->makeDirectory($path);
        return $path;
    }
}
