@extends('layouts.app')
@section('content')
	<div class="container">
		{{ Breadcrumbs::render('blog.posts.show',['slug'=>$item->slug,'title'=>$item->title,'locale'=>$locale]) }}
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">

					<div class="card">
					<div class="card-body">
						<div>
								<h1>{{ $item->title }}</h1>
						</div>
						<div>
							{!! $item->content_html !!}
						</div>
						<div>
							@foreach ($itemCategories as $category)
								<a href="{{ route('locale.blog.categories.show',['slug'=>$category->category->slug,'locale'=>$locale]) }}" title="@lang('messages.show')">
								 <span class="badge badge-info">{{ $category->category->title }}</span>
								</a>
							@endforeach
						</div>
						<div>
							<span>{{ $item->author->name }}</span>
							<span>{{ $item->updated_at }}</span>
						</div>
					</div>
				</div>
				</div>

			</div>
		</div>
	</div>
@endsection