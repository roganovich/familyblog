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
                                 <a href="{{ route('locale.blog.posts.show',['id'=>$item->id,'locale'=>$locale]) }}" title="@lang('messages.show')">
                                    <span>{{ $item->title }}</span>
                                    </a>
                            </div>
                            <div>
                                <span>{!! $item->content_html !!}</span>
                            </div>
                            <div>
                                <span>
                                    @foreach ($item->categories as $category)
                                        <span class="badge badge-info">{{ $category->category->title }}</span>
                                    @endforeach
                                </span>
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
