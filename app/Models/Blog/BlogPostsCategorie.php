<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPostsCategorie extends Model
{
    use SoftDeletes;

    public function category(){
        return $this->belongsTo(BlogCategorie::class,'category_id','id');
    }

    public function post(){
        return $this->belongsTo(BlogPost::class,'post_id','id');
    }
}
