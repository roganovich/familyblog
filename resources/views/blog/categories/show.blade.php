@extends('layouts.app')
@section('content')
	<div class="container blogcontainer">
		{{ Breadcrumbs::render('blog.categories.show',['slug'=>$item->slug,'title'=>$item->title,'locale'=>$locale]) }}
		<div class="row justify-content-center">
			<div>
				<h1>{{ $item->title }}</h1>
			</div>
			@if($itemPosts)
				<div class="row justify-content-center">
					@foreach ($itemPosts as $item)
						@include('blog.posts._item', ['item' => $item->post])
					@endforeach
				</div>
			@endif;
		</div>
	</div>
@endsection

