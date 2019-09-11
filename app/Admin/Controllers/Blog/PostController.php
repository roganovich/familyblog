<?php

namespace App\Admin\Controllers\Blog;

use App\Models\Blog\PostsCategorie;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Image;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends AdminController
{
    protected $title = 'Posts';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function grid()
    {

        $grid = new Grid(new Post);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('category_id', __('messages.category_id'));
        $grid->column('title', __('messages.title'));
        $grid->column('author_id', __('messages.author_id'));
        $grid->column('is_published', __('messages.is_published'));
        $grid->column('updated_at', __('messages.updated_at'));

        return $grid;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('messages.ID'));
        $show->field('title', __('messages.title'));
        $show->field('slug', __('messages.slug'));
        $show->field('content_html', __('messages.content_html'));
        $show->field('author_id', __('messages.author_id'));
        $show->field('is_published', __('messages.is_published'));
        $show->field('updated_at', __('messages.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new Post);

        $form->display('id', __('messages.ID'));
        $form->multipleImage('images', trans('messages.images'));
        $form->listbox('category_id', trans('messages.category_id'))->options(Category::all()->pluck('title', 'id'));
        $form->text('title', __('messages.title'));
        $form->text('slug', __('messages.slug'));
        $form->textarea('content_html', __('messages.content_html'));
        $form->select('author_id', trans('messages.author_id'))->options(User::all()->pluck('name', 'id'));
        $form->select('is_published', trans('messages.is_published'))->options(['1'=>'Да','0'=>'Нет']);
        $form->display('updated_at', __('messages.updated_at'));

        return $form;
    }

    public function update($id)
    {

        $imgModel = new Image();
        $imgModel->object = Post::findOrFail($id);
        $imgModel->images = request()->file('images');
        $imgModel->uploadload();
        return $this->form()->update($id);
    }
}
