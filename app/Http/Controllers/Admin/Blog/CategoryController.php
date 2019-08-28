<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Models\Blog\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Category::select(['id','title', 'slug', 'description'])
            ->orderBy('level','desc')
            ->orderBy('updated_at','asc')
            ->get();
        return view('admin.blog.categories.index', ['items'=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Category();
        return view('admin.blog.categories.create',['item'=>$item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Category();
        $data = $request->input();
        $data['slug'] = (empty($data['slug']))?Str::slug($data['title']):$data['slug'];
        if($item->create($data)){
            return redirect()
                ->route('locale.admin.blog.categories.index',['locale'=>App()->getLocale()])
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
        $item = Category::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись #{$id} не найдена!"])
                ->withInput();
        }
        return view('admin.blog.categories.edit',['item'=>$item]);
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

        $item = Category::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись #{$id} не найдена!"])
                ->withInput();
        }
        $data= $request->input(); //Не валидированные данные
        $data['slug'] = (empty($data['slug']))?Str::slug($data['title']):$data['slug'];
        if($item->update($data)){
            return redirect()
                ->route('locale.admin.blog.categories.index',['locale'=>App()->getLocale()])
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
