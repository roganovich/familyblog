<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class Image extends Model
{
    use SoftDeletes;


    protected $table = 'images';
    protected $fillable = [
        'title', 'img_path', 'img_name', 'level', 'obj_class', 'obj_id'
    ];

    public function deleteImage(){
        Storage::disk('uploads')->delete($this->img_path);
        $this->forceDelete();
    }

    public static function getNoThumb(){
        $item = new Image();
        $item->id = 0;
        $item->img_path = '/images/nothumb.jpg';
        return $item;
    }
    public function getThumb($width, $height){
        //полный путь к изображению
        $url = Storage::disk('uploads')->path($this->img_path);
        //информация о файле
        $info = pathinfo(storage_path().$url);

        //путь к сохранению файла
        $base_path = str_replace($info['basename'],'',$url);

        //полный пукть к минеатюре
        $thumb_name = $base_path.$info['filename'].'_'.$width.'x'.$height.'.'.$info['extension'];
        //если миниатюры нет, то создаем ее.
        if(!file_exists($thumb_name)){
            copy($url,$thumb_name);
            $image = new ImageManager();
            $image->make($thumb_name)->fit($width, $height)->save();
        }
        //возвращаем миниарюру
        return $thumb_name;

    }

}
