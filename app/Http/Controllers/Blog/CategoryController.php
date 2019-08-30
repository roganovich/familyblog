<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $slug)
    {
        $item = Category::select(['id', 'title', 'slug'])->where(['slug'=>$slug])->first();
        $itemPosts = $item->posts;
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись #{$slug} не найдена!"])
                ->withInput();
        }
        return view('blog.categories.show',['item' => $item,'itemPosts'=>$itemPosts]);
    }


}
