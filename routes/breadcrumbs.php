<?php

//*******************************************Admin Group ********************************************************/
//Categories Breadcrumbs
Breadcrumbs::register('admin.blog.categories.index', function ($breadcrumbs,$items) {
    $breadcrumbs->push(__('messages.categories_list') , route('locale.admin.blog.categories.index',$items['locale']));
});
Breadcrumbs::register('admin.blog.categories.create', function ($breadcrumbs,$items) {
    $breadcrumbs->parent('admin.blog.categories.index',$items);
    $breadcrumbs->push(__('messages.categories_create') , route('locale.admin.blog.categories.create',$items['locale']));
});
Breadcrumbs::register('admin.blog.categories.edit', function ($breadcrumbs,$items) {
    $breadcrumbs->parent('admin.blog.categories.index',$items);
    $breadcrumbs->push(__('messages.categories_edit').': '.$items['title'] , route('locale.admin.blog.categories.edit',['id'=>$items['id'],'locale'=>$items['locale']]));
});

//Posts Breadcrumbs
Breadcrumbs::register('admin.blog.posts.index', function ($breadcrumbs,$items) {
    $breadcrumbs->push(__('messages.posts_list') , route('locale.admin.blog.posts.index',$items['locale']));
});

Breadcrumbs::register('admin.blog.posts.create', function ($breadcrumbs,$items) {
    $breadcrumbs->parent('admin.blog.posts.index',$items);
    $breadcrumbs->push(__('messages.posts_create') , route('locale.admin.blog.posts.create',$items['locale']));
});
Breadcrumbs::register('admin.blog.posts.edit', function ($breadcrumbs,$items) {
    $breadcrumbs->parent('admin.blog.posts.index',$items);
    $breadcrumbs->push(__('messages.posts_edit').': '.$items['title'] , route('locale.admin.blog.posts.edit',['id'=>$items['id'],'locale'=>$items['locale']]));
});
//Images Breadcrumbs
Breadcrumbs::register('admin.images.index', function ($breadcrumbs,$items) {
    $breadcrumbs->push(__('messages.images') , route('locale.admin.images.index',$items['locale']));
});



//*******************************************Blog Group ********************************************************/

//Categories Breadcrumbs
Breadcrumbs::register('blog.categories.index', function ($breadcrumbs,$items) {
    $breadcrumbs->push(__('messages.categories_list') , route('locale.blog.categories.index',$items['locale']));
});

Breadcrumbs::register('blog.categories.show', function ($breadcrumbs,$items) {
    $breadcrumbs->parent('blog.categories.index',$items);
    $breadcrumbs->push($items['title'] , route('locale.blog.categories.show',['slug'=>$items['slug'],'locale'=>$items['locale']]));
});

//Posts Breadcrumbs
Breadcrumbs::register('blog.posts.index', function ($breadcrumbs,$items) {
    $breadcrumbs->push(__('messages.posts_list') , route('locale.blog.posts.index',$items['locale']));
});

Breadcrumbs::register('blog.posts.show', function ($breadcrumbs,$items) {
    $breadcrumbs->parent('blog.posts.index',$items);
    $breadcrumbs->push($items['title'] , route('locale.blog.posts.show',['slug'=>$items['slug'],'locale'=>$items['locale']]));
});