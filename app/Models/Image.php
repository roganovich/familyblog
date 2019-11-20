<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


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

}
