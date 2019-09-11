<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    private $_images;
    private $_object;
    private $_path;

    protected $table = 'images';
    protected $fillable = [
        'title', 'img_path', 'img_name', 'level', 'obj_class', 'obj_id'
    ];

    public function uploadload(){
        dd($this->images);
        $i = 1;
        foreach ($this->images as $f) {
            $filename = md5($this->object->id) .'.' . $f->getClientOriginalExtension() ?: 'png';
            $img = ImageInt::make($f);
            $img->resize(200,200)->save($this->path . '/' . $this->object->id .' / ' . $filename);
            Image::create([
                'title' => $this->object->title,
                'img' => $filename,
                'obj_class' => get_class($this->object),
                'obj_id' => $this->object->id,
                'img_path' => $this->path,
                'img_name' => $filename,
                'level'=>$i]);
            $i++;
        }
    }

    public function setImages($files){
        $this->_images = $files;
    }

    public function getImages(){
        return $this->_images;
    }

    public function setObject($object){
        $this->_object = $object;
        $this->setPath();
    }

    public function getObject(){
        return $this->_object;
    }

    public function setPath($path = ''){
        if(!$path){
            $this->_path = public_path().'/'.get_class($this->object);
        }
        $this->_path = $path;
    }

    public function getPath(){
        return $this->_path;
    }
}
