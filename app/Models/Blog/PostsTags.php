<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Blog\Tag;

class PostsTags extends Model
{
    use SoftDeletes;

    protected $table = "blog_tags_posts";
    public $timestamps = false;

    protected $fillable  = [
        'tag_id',
        'post_id',
    ];

    public function category(){
        return $this->belongsTo(Tag::class,'tag_id','id');
    }

    public function post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
