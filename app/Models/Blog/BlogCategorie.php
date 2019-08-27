<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategorie extends Model
{
    use SoftDeletes;

    protected $fillable  = [
        'title',
        'slug',
        'description',
        'level',
        'is_published'
    ];
}
