@extends('layouts.app')
@section('content')
    <div class="container blogcontainer">
        {{ Breadcrumbs::render('blog.posts.index',['locale'=>$locale]) }}
        <div class="row justify-content-center">
            @foreach ($items as $item)
                @include('blog.posts._item', ['item' => $item])
            @endforeach
        </div>
    </div>
@endsection
