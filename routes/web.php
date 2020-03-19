<?php

//Default static page
Route::get('/{locale}', function () {
    return view('welcome');
});
/*Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getView']);
Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
*/
//chage locale. matual route
Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {   # Проверяем, что у пользователя выбран доступный язык
        Session::put('locale', $locale);                    # И устанавливаем его в сессии под именем locale
    }

    return redirect()->back();                              # Редиректим его <s>взад</s> на ту же страницу
});


Route::group(['prefix'=>'{locale}','name'=>'locale.'], function($locale){

    Route::get('/', 'SiteController@index')->name('locale.site.index');
    Route::get('/images/thumb/{img}/{width}/{height}', 'ImagesController@thumb')->name('locale.images.thumb');


    //Moderate Frontend routes Group
    Route::group(['namespace'=>'Moderate','prefix'=>'/moderate','name'=>'moderate.'], function(){
        Route::get('/images/destroy/{id}', 'ImagesController@destroy')->name('locale.moderate.images.destroy');
        //Moderate Blogs Frontend routes Group
        Route::group(['namespace'=>'Blog','prefix'=>'/blog','name'=>'blog.'], function(){
            Route::get('/posts/create}', 'PostController@create')->name('locale.moderate.blog.posts.create');
            Route::get('/posts/store}', 'PostController@store')->name('locale.moderate.blog.posts.store');
            Route::get('/posts/edit/{id}', 'PostController@edit')->name('locale.moderate.blog.posts.edit');
            Route::post('/posts/update/{id}', 'PostController@update')->name('locale.moderate.blog.posts.update');
            Route::get('/posts/destroy/{id}', 'PostController@destroy')->name('locale.moderate.blog.posts.destroy');

            Route::get('/categories/create}', 'CategoryController@create')->name('locale.moderate.blog.categories.create');
            Route::get('/categories/store}', 'CategoryController@store')->name('locale.moderate.blog.categories.store');
            Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('locale.moderate.blog.categories.edit');
            Route::post('/categories/update/{id}', 'CategoryController@update')->name('locale.moderate.blog.categories.update');
            Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('locale.moderate.blog.categories.destroy');
        });
    });
    //Blogs Frontend routes Group
    Route::group(['namespace'=>'Blog','prefix'=>'/blog','name'=>'blog.'], function(){

        Route::get('/', function ($locale) {
            return redirect()->route('locale.blog.posts.index',['locale'=>$locale]);
        });


        //Frontend Categories routes
        Route::resource('categories','CategoryController')
            ->only(['index','show'])
            ->names('locale.blog.categories');

        //Frontend Posts routes
        Route::get('/posts', 'PostController@index')->name('locale.blog.posts.index');
        Route::get('/posts/show/{slug}', 'PostController@show')->name('locale.blog.posts.show');
        Route::get('/posts/edit/{id}', 'PostController@edit')->name('locale.blog.posts.edit');
        Route::get('/posts/author/{author_id}', 'PostController@author')->name('locale.blog.posts.author');
        Route::get('/posts/date/{date}', 'PostController@date')->name('locale.blog.posts.date');
    });
});



//Auth routes
//Auth::routes();