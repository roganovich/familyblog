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
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;


class PostController extends AdminController
{
    protected $title = 'Posts';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function grid() {

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
            return ($value) ? __('messages.yes') : __('messages.no');
        });
        $grid->column('updated_at', __('messages.updated_at'));

        return $grid;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function detail($id) {

        $model = Post::findOrFail($id);
        $show = new Show($model);

        //$show->field('id', __('messages.ID'));
        $show->field('title', __('messages.title'));
        $show->field('slug', __('messages.slug'));
        $show->divider();
        $show->field('content_html', __('messages.content_html'));
        $show->divider();

        $show->categories()->as(function ($categories) {
            $str = '';
            foreach ($categories as $category) {
                $str .= '<span class=\'label label-warning\'>';
                $str .= '<a href="{{ route(\'admin.blog.categories.edit\',[\'id\'=> $category->id) }}" title="' . $category->title . '">';
                $category->title;
                $str .= '</a>';
                $str .= '</span>';
            }
            return $str;
        });

        $show->divider();

        foreach ($model->images as $img) {
            $show->image(public_path().'/uploads/'.$img->img_path);
        }

        /*$show->images()->as(function ($images) {
            $str = '';
            foreach ($images as $image) {
                $str .= '<img src="' . $image->img_path . '" title="'.$image->title.'"/>';
            }
            return $str;
        });*/

        $show->divider();

        $show->author()->as(function ($author) {
            return $author->name;
        });

        $show->field('is_published', __('messages.is_published'));
        $show->field('updated_at', __('messages.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form() {

        $form = new Form(new Post);
        $form->display('id', __('messages.ID'));
        //$form->multipleFile('images', trans('messages.images'))->sortable()->removable();
        $form->multipleImage('images')->sortable();

        //$form->multipleSelect('categories', trans('messages.category_id'))->options(Category::all()->pluck('title', 'id'));
        $form->text('title', __('messages.title'));
        $form->text('slug', __('messages.slug'));
        //$form->textarea('content_html', __('messages.content_html'));
        $form->ckeditor('content_html', __('messages.content_html'))->options(['lang' => 'ru', 'height' => 500]);
        $form->select('author_id', trans('messages.author_id'))->options(User::all()->pluck('name', 'id'));
        $form->select('is_published', trans('messages.is_published'))->options(['1' => 'Да', '0' => 'Нет']);
        $form->datetime('updated_at', __('messages.updated_at'));

        return $form;
    }



    public function edit($id, Content $content)
    {

        /*$data = Session::all();
        $input = \Illuminate\Support\Facades\Input::all();
        dd($data);*/
        $model = Post::findOrFail($id);
        $return =  $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));

        return $return;
    }


    public function update($id)
    {

        $imgModel = new Uploader();
        $imgModel->object = Post::findOrFail($id);
        $imgModel->images = request()->file('images');
        $imgModel->object->clearImages();
        $imgModel->uploadload();

        return $this->form()->update($id);
    }
}
