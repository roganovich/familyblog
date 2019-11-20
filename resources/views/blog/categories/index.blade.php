@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('blog.posts.index',['locale'=>$locale]) }}
        <div class="row justify-content-center">

            @foreach ($items as $item)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                 <a href="{{ route('locale.blog.categories.show',['slug'=>$item->slug,'locale'=>$locale]) }}" title="@lang('messages.show')">
                                    <span>{{ $item->title }}</span>
                                 </a>
                            </div>

                            <div>
                                <span>
                                    @foreach ($item->posts as $post)
                                        <a href="{{ route('locale.blog.posts.show',['slug'=>$post->slug,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $post->title }}">
                                            <span class="badge badge-info">{{ $post->title }}</span>
                                        </a>
                                    @endforeach
                                </span>
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
