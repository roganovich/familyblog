<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Post::select(['id', 'title', 'intro_html', 'slug','updated_at','author_id'])
            ->orderBy('updated_at','asc')
            ->paginate(9);
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

        $item = Post::select(['id', 'title', 'content_html', 'slug','updated_at','author_id'])->where(['slug'=>$slug])->first();
        $itemCategories = $item->categories;
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись #{$slug} не найдена!"])
                ->withInput();
        }
        return view('blog.posts.show',['item' => $item,'itemCategories'=>$itemCategories]);
    }

    public function author($locale, $author_id)
    {
        $items = Post::select(['id', 'title', 'intro_html', 'slug','updated_at','author_id'])
            ->where(['author_id'=>$author_id])
            ->orderBy('updated_at','asc')
            ->paginate(9);
        return view('blog.posts.index',['items' => $items]);
    }

    public function date($locale, $date)
    {
        $items = Post::select(['id', 'title', 'intro_html', 'slug','updated_at','created_at','author_id'])
            ->where('created_at','like', Carbon::parse( $date)->format('Y-m-d').'%')
            ->orderBy('updated_at','asc')
            ->paginate(9);
        return view('blog.posts.index',['items' => $items]);
    }

}
