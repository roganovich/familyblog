<?php

namespace App\Admin\Controllers\Blog;

use App\Models\Blog\PostsCategorie;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Uploader;
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
        $grid->categories(__('messages.categories'))->display(function ($categories) {
            $count = count($categories);
            return "<span class='label label-warning'>{$count}</span>";
        });
        $grid->column('title', __('messages.title'));

        $grid->column('author', __('messages.author'))->display(function ($value) {
            return $value['name'];
        });
        $grid->column('is_published', __('messages.is_published'))->display(function ($value) {
            return ($value)?__('messages.yes'):__('messages.no');
        });
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
        //$form->textarea('content_html', __('messages.content_html'));
        $form->ckeditor('content_html', __('messages.content_html'))->options(['lang' => 'ru', 'height' => 500]);
        $form->select('author_id', trans('messages.author_id'))->options(User::all()->pluck('name', 'id'));
        $form->select('is_published', trans('messages.is_published'))->options(['1'=>'Да','0'=>'Нет']);
        $form->display('updated_at', __('messages.updated_at'));

        return $form;
    }

    public function update($id)
    {

        $imgModel = new Uploader();
        $imgModel->object = Post::findOrFail($id);
        $imgModel->images = request()->file('images');
        $imgModel->uploadload();
        return $this->form()->update($id);
    }
}
