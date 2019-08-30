<?php

namespace App\Models\Blog;



use App\Models\Blog\PostsCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Blog\Post;

class Category extends Model
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

    public function isCheckInPost(Post $post){
        return (PostsCategories::where(['category_id'=>$this->id,'post_id'=>$post->id])->count());
    }

    public function posts(){
        return $this->hasMany(PostsCategories::class,'category_id','id');
    }
}
