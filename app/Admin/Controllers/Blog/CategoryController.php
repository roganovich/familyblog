<?php

namespace App\Admin\Controllers\Blog;

use App\Models\Blog\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends AdminController
{

    protected $title = 'Categories';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function grid()
    {

        $grid = new Grid(new Category);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('messages.title'));
        $grid->column('slug', __('messages.slug'));
        $grid->column('description', __('messages.description'));
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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('messages.ID'));
        $show->field('title', __('messages.title'));
        $show->field('slug', __('messages.slug'));
        $show->field('description', __('messages.description'));
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

        $form = new Form(new Category);

        $form->display('id', __('messages.ID'));
        $form->text('title', __('messages.title'));
        $form->text('slug', __('messages.slug'));
        $form->text('description', __('messages.description'));
        $form->display('updated_at', __('messages.updated_at'));

        return $form;
    }



}
