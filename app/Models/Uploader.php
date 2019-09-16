<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Uploader extends Model
{

    protected $attributes = ['_images'=>'','_object'=>'','_path'=>''];

    public function uploadload(){
        $i = 1;
        foreach ($this->images as $f) {
            $extension = $f->getClientOriginalExtension();
            $filename = md5($this->object->id) .'.' . $extension ?: 'png';
            $filepath = $this->path  . $filename;
            //echo  $filepath.'<br>';
            //  $f->getFilename()
            //Storage::disk('public')->put($filepath,  File::get($f));
            //$img = ImageInt::make($f);
            //$img->resize(200,200)->save($filepath);
            $img = new Image();
            $img->title = $this->object->title;
            $img->obj_class = get_class($this->object);
            $img->obj_id = $this->object->id;
            $img->img_path = $filepath;
            $img->img_name = $filename;
            $img->level = $i;
            $img->save();
            $i++;
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
        return  class_basename($this->object). '/' . $this->object->id . '/';
    }
}
