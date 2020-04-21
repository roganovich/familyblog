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
        //if(file_exists($thumb_name)){unlink($thumb_name);}

        if(!file_exists($thumb_name)){
            copy($url,$thumb_name);
            $image = new ImageManager();
            $original_watermark = public_path('/images/watermark.png');
            $new_watermark = public_path('/images/watermark_'.$width.'x'.$height.'.png');
            //if(file_exists($new_watermark)){unlink($new_watermark);}

            if(!file_exists($new_watermark)) {
                copy($original_watermark,$new_watermark);
                $watermark = new ImageManager();
                $resizePercentage = 90;//70% less then an actual image (play with this value)
                $widthSize = round($width * ((100 - $resizePercentage) / 100), 2);
                $heightSize = round($height * ((100 - $resizePercentage) / 100), 2);
                $watermark->make($new_watermark)
                    ->resize($widthSize, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save();
                //dd($new_watermark,$widthSize,$heightSize,$watermark);
            }
            $image->make($thumb_name)
                ->fit($width, $height)
                ->insert($new_watermark,  'center')
                ->insert($new_watermark,  'top-left', 10, 10)
                ->insert($new_watermark,  'top-right', 10, 10)
                ->insert($new_watermark, 'bottom-left', 10, 10)
                ->insert($new_watermark,  'bottom-right', 10, 10)
                ->save();
        }
        //возвращаем миниарюру
        return $thumb_name;

    }

}
