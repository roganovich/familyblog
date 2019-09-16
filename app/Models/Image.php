<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Image extends Model
{
    use SoftDeletes;


    protected $table = 'images';
    protected $fillable = [
        'title', 'img_path', 'img_name', 'level', 'obj_class', 'obj_id'
    ];

}
