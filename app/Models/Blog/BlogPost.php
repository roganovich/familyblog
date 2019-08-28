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
        return $this->hasMany(BlogPostsCategorie::class,'post_id','id');
        //return $this->belongsToMany(BlogPostsCategorie::class, 'blog_posts_categories', 'id', 'post_id');
    }

    public function author(){
        return $this->belongsTo(User::class,'author_id','id');
    }

    /**
     * Return all categories of this post
     * @return array
     */
    public function getParentTitleAttribute(){
        return $this->parentCategory->title ?? ($this->isRoot() ? 'Корень':'?');
    }
}
