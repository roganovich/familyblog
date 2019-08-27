<?php

namespace App\Models\Blog;

use App\Models\BlogCategory;
use App\Models\Blog\BlogPostsCategorie;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable  = [
        'title',
        'slug',
        'content_html',
        'is_published'
    ];

    public function categories(){
        return $this->hasMany(BlogPostsCategorie::class,'id','post_id');
    }

    public function author(){
        return $this->belongsTo(User::class,'author_id','id');
    }
}
