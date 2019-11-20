<?php

namespace App\Http\Controllers\Moderate\Blog;

use App\Http\Controllers\Moderate;
use App\Http\Requests\PostFormRequest;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use App\Repositories\BlogPostRepository;

class PostController extends Moderate
{
    private $blogPostRepository;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->blogPostRepository = app(BlogPostRepository::class);
    }

    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginator(25);
        return view('moderate.blog.posts.index', ['paginator'=>$paginator]);
    }

    public function create()
    {
        $item = new Post();
        $categoryList = $this->blogPostRepository->getCategoriesList();
        return view('moderate.blog.posts.edit',['item'=>$item, 'categoryList'=>$categoryList]);
    }

    public function store($locale, PostFormRequest $request)
    {
        $data = $request->input(); //validate request
        $item = new Post(); //new model object
        if($item->create($data)){//check succes result
            return redirect()
                ->route('moderate.blog.posts.index')
                ->with(['success'=>'Успешно!']);
        }else{//error msg and redirect
            return back()
                ->withErrors(['msg'=>"Ошибка сохранения!"])
                ->withInput();
        }
    }

    public function edit($locale, $id)
    {
        $item = $this->blogPostRepository->getForeEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList = $this->blogPostRepository->getCategoriesList();
        return view('moderate.blog.posts.edit',['item'=>$item, 'categoryList'=>$categoryList]);
    }

    public function update($locale, $id, PostFormRequest $request)
    {
        $item = Post::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись #{$id} не найдена!"])
                ->withInput();
        }
        if($item->update($request->input())){
            return redirect()
                ->route('locale.moderate.blog.posts.edit', ['id'=>$item->id,'local'=>$this->locale])
                ->with(['success'=>'Успешно!']);
        }else{
            return back()
                ->withErrors(['msg'=>"Ошибка сохранения!"])
                ->withInput();
        }
    }

    public function destroy($locale,$id)
    {
        if(Post::destroy($id)){
            return redirect()
                ->route('moderate.blog.posts.index')
                ->with(['success'=>'Успешно!']);
        }else{
            return back()
                ->withErrors(['msg'=>"Ошибка удаления!"])
                ->withInput();
        }
    }

}
