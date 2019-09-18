<?php

namespace App\Models\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\PostsCategories;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = "blog_posts";

    protected $fillable  = [
        'title',
        'slug',
        'is_published',
        'author_id',
        'content_html',
        'updated_at',
        'created_at'
    ];

    public function categories(){
        //return $this->hasMany(PostsCategories::class,'post_id','id');
        //return $this->belongsToMany(PostsCategories::class, 'blog_posts_categories', 'id', 'post_id');
        return $this->hasManyThrough(
            Category::class, PostsCategories::class,
            'post_id', 'id', 'id','category_id'
        );
    }

    public function author(){
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function images(){
        return $this->hasMany(Image::class,'obj_id','id', 'obj_class', Post::class);
        //return $this->hasMany(Image::class,'obj_id','id', 'obj_class', Post::class);
    }




}
