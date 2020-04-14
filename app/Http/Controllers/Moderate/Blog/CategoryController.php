<?php

namespace App\Http\Controllers\Moderate\Blog;

use App\Http\Controllers\Moderate;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use App\Repositories\BlogCategoryRepository;

class CategoryController extends Moderate
{
    private $blogCategoryRepository;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

   public function create($locale)
    {
        $item = new Category();
        return view('moderate.blog.categories.edit',['item'=>$item]);
    }

    public function store($locale, CategoryFormRequest $request)
    {
        $data = $request->input(); //validate request
        $item = new Category(); //new model object
        if($item->create($data)){//check succes result
            return redirect()
                ->route('locale.blog.categories.index', ['local'=>$this->locale])
                ->with(['success'=>'Успешно!']);
        }else{//error msg and redirect
            return back()
                ->withErrors(['msg'=>"Ошибка сохранения!"])
                ->withInput();
        }
    }

    public function edit($locale, $id)
    {
        $item = $this->blogCategoryRepository->getForeEdit($id);
        if(empty($item)){
            abort(404);
        }
        return view('moderate.blog.categories.edit',['item'=>$item]);
    }

    public function update($locale, CategoryFormRequest $request, $id)
    {
        $item = Category::find($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись #{$id} не найдена!"])
                ->withInput();
        }
        if($item->update($request->input())){
            return redirect()
                ->route('locale.blog.categories.index', ['local'=>$this->locale])
                ->with(['success'=>'Успешно!']);
        }else{
            return back()
                ->withErrors(['msg'=>"Ошибка сохранения!"])
                ->withInput();
        }
    }

    public function destroy($locale,$id)
    {
        if(Category::destroy($id)){
            return redirect()
                ->route('moderate.blog.categories.index')
                ->with(['success'=>'Успешно!']);
        }else{
            return back()
                ->withErrors(['msg'=>"Ошибка удаления!"])
                ->withInput();
        }
    }

}
