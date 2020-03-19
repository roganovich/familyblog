<?php

namespace App\Models\Blog;



use App\Models\Blog\PostsCategories;
use App\Models\Image;
use App\Models\Uploader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Blog\Post;
use Illuminate\Support\Facades\Storage;

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

    public function getThumbAttribute()
    {
        if($this->images){
            return $this->images[0];
        }
        return  Image::getNoThumb();
    }

    public function getImagesAttribute()
    {
        $objects = [];
        $images =  Image::select(['img_path', 'title', 'id'])
            ->where(['obj_id'=>$this->id, 'obj_class'=>get_class($this)])
            ->get();
        $return = [];
        foreach ($images as $img) {
            $return[] = ['title'=>$img->title,'id'=>$img->id,'path'=>'/uploads/'.$img->img_path];
        }
        return $return;
    }

    public function clearImages() {
        $images =  Image::where(['obj_id'=>$this->id, 'obj_class'=>get_class($this)])->get();
        foreach ($images as $img){
            Storage::disk('uploads')->delete($img->img_path);
            $img->forceDelete();
        }
    }

    public function update(array $attributes = [], array $options = []) {
        if ($files = request()->file('files')) {
            $imgModel = new Uploader();
            $imgModel->object = $this;
            $imgModel->files = $files;
            //$imgModel->object->clearImages();
            $imgModel->uploadload();
        }
        return parent::update($attributes, $options);
    }
}
