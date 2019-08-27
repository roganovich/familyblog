<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//группа маршрутов для админки
Route::group(['namespace'=>'Admin\Blog','prefix'=>'admin/blog'], function(){
    //список методов
    $methods = ['index','edit','store','update','create','destroy'];

    Route::resource('categories','BlogCategorieController')
        ->only($methods)
        ->names('admin.blog.categories');

    Route::resource('posts','BlogPostController')
        ->except(['show'])
        ->names('admin.blog.posts');
});
Auth::routes();