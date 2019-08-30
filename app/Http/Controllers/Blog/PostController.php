<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Post::select(['id', 'title', 'intro_html', 'slug','updated_at'])
            ->orderBy('updated_at','asc')
            ->get();
        return view('blog.posts.index', ['items'=>$items]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $slug)
    {

        $item = Post::select(['id', 'title', 'intro_html', 'slug','updated_at','author_id'])->where(['slug'=>$slug])->first();
        $itemCategories = $item->categories;
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись #{$slug} не найдена!"])
                ->withInput();
        }
        return view('blog.posts.show',['item' => $item,'itemCategories'=>$itemCategories]);
    }

}
