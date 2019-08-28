<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategorie extends Model
{
    use SoftDeletes;

    protected $table = "blog_categories";

    protected $fillable  = [
        'title',
        'slug',
        'description',
        'level',
        'is_published',
        'updated_at',
        'created_at'
    ];
}
