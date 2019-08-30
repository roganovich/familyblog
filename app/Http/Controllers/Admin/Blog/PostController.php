<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Models\Blog\PostsCategorie;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Post::select(['id','title', 'slug','updated_at'])
            ->orderBy('updated_at','asc')
            ->get();
        return view('admin.blog.posts.index', ['items'=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Post();
        $categoryList = Category::select(['id','title'])
            ->orderBy('level','desc')
            ->orderBy('updated_at','asc')
            ->get();
        return view('admin.blog.posts.create',['item'=>$item,'categoryList'=>$categoryList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $item = new Post();
        $data = $request->input();
        $data['author_id'] = 1;
        $data['slug'] = (empty($data['slug']))?Str::slug($data['title']):$data['slug'];

        if($save = Post::create($data)){
            //Set categoryes to PostsCategories
            $items = PostsCategorie::where(['post_id'=>$save->id])->delete();
            foreach ($data['categories'] as $category){
                /*$dataCategoryPost['category_id'] = $category;
                $dataCategoryPost['post_id'] = $save->id;
                PostsCategories::create($dataCategoryPost);*/

                $model = new BlogPostsCategorie();
                $model->category_id = $category;
                $model->post_id = $save->id;
                $model->save();
            }
            return redirect()
                ->route('locale.admin.blog.posts.index',['locale'=>App()->getLocale()])
                ->with(['success'=>'Успешно!']);
        }else{
            return back()
                ->withErrors(['msg'=>"Ошибка сохранения!"])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale,$id)
    {
        $item = Post::find($id);
        $categoryList = Category::select(['id','title'])
            ->orderBy('level','desc')
            ->orderBy('updated_at','asc')
            ->get();
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись #{$id} не найдена!"])
                ->withInput();
        }
        return view('admin.blog.posts.edit',['item' => $item,'categoryList' => $categoryList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, $id)
    {
        $item = Post::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись #{$id} не найдена!"])
                ->withInput();
        }
        $data= $request->input(); //Не валидированные данные
        $data['author_id'] = 1;
        $data['slug'] = (empty($data['slug']))?Str::slug($data['title']):$data['slug'];

        if($item->update($data)){
            $items = BlogPostsCategorie::where(['post_id'=>$item->id])->delete();
            if(array_key_exists('categories',$data)){
                foreach ($data['categories'] as $category){
                    $model = new BlogPostsCategorie();
                    $model->category_id = $category;
                    $model->post_id = $item->id;
                    $model->save();
                }
            }
            return redirect()
                ->route('locale.admin.blog.posts.index',['locale'=>App()->getLocale()])
                ->with(['success'=>'Успешно!']);
        }else{
            return back()
                ->withErrors(['msg'=>"Ошибка сохранения!"])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}