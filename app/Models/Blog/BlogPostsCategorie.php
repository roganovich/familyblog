<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPostsCategorie extends Model
{
    use SoftDeletes;

    protected $table = "blog_posts_categories";
    public $timestamps = false;

    protected $fillable  = [
        'category_id',
        'post_id',
    ];

    public function category(){
        return $this->belongsTo(BlogCategorie::class,'category_id','id');
    }

    public function post(){
        return $this->belongsTo(BlogPost::class,'post_id','id');
    }
}
