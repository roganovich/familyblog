@extends('layouts.app')
@section('content')
    @include('site.mainslider',['items'=>$items])
    <div class="container blogcontainer">
        <!--{{ Breadcrumbs::render('blog.posts.index',['locale'=>$locale]) }}-->
        <div class="infinite-scroll">
            <div class="row justify-content-center">
                @foreach ($items as $key=>$item)
                    @if($key >= 3)
                        @include('blog.posts._item', ['item' => $item])
                    @endif
                @endforeach
            </div>
            {{ $items->links() }}
        </div>
    </div>
@endsection


