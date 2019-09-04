@extends('layouts.app')
@section('content')
    <div class="container blogcontainer">
        {{ Breadcrumbs::render('blog.posts.index',['locale'=>$locale]) }}
        <div class="row justify-content-center">

            @foreach ($items as $item)
                <div class="col-md-4">
                    <div class="card post_item">
                        <div class="card-body">
                            <div>
                                 <a href="{{ route('locale.blog.posts.show',['id'=>$item->id,'locale'=>$locale]) }}" title="@lang('messages.show')">
                                    <h2>{{ $item->title }}</h2>
                                 </a>
                            </div>
                            <div class="post_html">
                                {!! $item->intro_html !!}
                            </div>
                            <div class="post_categories">
                                    @foreach ($item->categories as $category)
                                        <a href="{{ route('locale.blog.categories.show',['slug'=>$category->category->slug,'locale'=>$locale]) }}" title="@lang('messages.show')">
                                            <span class="badge badge-info">{{ $category->category->title }}</span>
                                        </a>
                                    @endforeach
                            </div>
                            <div>
                                <span>{{ $item->author_id }}</span>
                            </div>
                            <div>
                                <span>{{ $item->updated_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
