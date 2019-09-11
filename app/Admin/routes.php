<?php

use Illuminate\Routing\Router;




//Blogs Admin routes Group
Route::group(['namespace'=>'App\Admin\Controllers','prefix'=>'/admin','name'=>'admin.'], function(){

    Route::get('/', 'HomeController@index')->name('admin.index');

    //Categories routes
    Route::resource('images','ImageController')
        ->names('admin.images');

    //Blogs Admin routes Group
    Route::group(['namespace'=>'Blog','prefix'=>'/blog','name'=>'admin.blog.'], function(){

        //Categories routes
        Route::get('/categories', 'CategoryController@index')->name('admin.blog.categories.index')->middleware(['web','admin']);
        Route::get('/categories/{id}', 'CategoryController@show')->name('admin.blog.categories.show')->middleware(['web','admin']);
        Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('admin.blog.categories.edit')->middleware(['web','admin']);
        Route::put('/categories/{id}', 'CategoryController@update')->name('admin.blog.categories.update')->middleware(['web','admin']);
        Route::get('/categories/create', 'CategoryController@create')->name('admin.blog.categories.create')->middleware(['web','admin']);
        Route::patch('/categories/store', 'CategoryController@store')->name('admin.blog.categories.store')->middleware(['web','admin']);
        //Posts routes
        Route::get('/posts', 'PostController@index')->name('admin.blog.posts.index')->middleware(['web','admin']);
        Route::get('/posts/{id}', 'PostController@show')->name('admin.blog.posts.show')->middleware(['web','admin']);
        Route::get('/posts/{id}/edit', 'PostController@edit')->name('admin.blog.posts.edit')->middleware(['web','admin']);
        Route::put('/posts/{id}', 'PostController@update')->name('admin.blog.posts.update')->middleware(['web','admin']);
        Route::get('/posts/create', 'PostController@create')->name('admin.blog.posts.create')->middleware(['web','admin']);
        Route::patch('/posts/store', 'PostController@store')->name('admin.blog.posts.store')->middleware(['web','admin']);
    });
});
Admin::routes();