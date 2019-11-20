<?php

namespace App\Models\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\PostsCategories;
use App\Models\Image;
use App\Models\Uploader;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


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
        'created_at',
        'images'
    ];

    public function categories(){
        return $this->hasMany(PostsCategories::class,'post_id','id');
    }

    public function author(){

        $userModelPath = config('admin.database.users_model');
        $userModel = new $userModelPath();
        return $this->belongsTo(get_class($userModel),'author_id','id');
    }


    public function getThumbAttribute()
    {
        return ($this->images)?$this->images[0]['path']:'/images/nothumb.jpg';
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
        $imgModel = new Uploader();
        $imgModel->object = $this;
        $imgModel->files = request()->file('files');
        //$imgModel->object->clearImages();
        $imgModel->uploadload();
        return parent::update($attributes, $options);
    }


}
