<?php

//Default static page
Route::get('/{locale}', function () {
    return view('welcome');
});

//chage locale. matual route
Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {   # Проверяем, что у пользователя выбран доступный язык
        Session::put('locale', $locale);                    # И устанавливаем его в сессии под именем locale
    }

    return redirect()->back();                              # Редиректим его <s>взад</s> на ту же страницу
});


Route::group(['prefix'=>'{locale}','name'=>'locale.'], function($locale){

    //Blogs Admin routes Group
    Route::group(['namespace'=>'Admin\Blog','prefix'=>'/admin/blog','name'=>'admin.blog.'], function(){

        //Categories routes
        Route::resource('categories','CategoryController')
            ->names('locale.admin.blog.categories');

        //Posts routes
        Route::resource('posts','PostController')
            ->names('locale.admin.blog.posts');
    });


    //Blogs Frontend routes Group
    Route::group(['namespace'=>'Blog','prefix'=>'/blog','name'=>'blog.'], function(){

        //Frontend Categories routes
        Route::resource('categories','CategoryController')
            ->only(['index','show'])
            ->names('locale.blog.categories');

        //Frontend Posts routes
        Route::resource('posts','PostController')
            ->only(['index','show'])
            ->names('locale.blog.posts');
    });
});



//Auth routes
Auth::routes();