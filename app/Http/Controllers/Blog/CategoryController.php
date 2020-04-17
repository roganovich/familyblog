<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Category;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct(Request $request) {
        parent::__construct($request);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }
    public function index()
    {
        $items = $this->blogCategoryRepository->getAllWithPaginator(9);
        return view('blog.categories.index', ['items'=>$items]);
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
