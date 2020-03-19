@extends('layouts.app')
@section('content')
	<div class="container blogcontainer">
		{{ Breadcrumbs::render('blog.posts.show',['slug'=>$item->slug,'title'=>$item->title,'locale'=>$locale]) }}
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card post_show">
					<div class="card-body">
						<div>
								<h1>{{ $item->title }}</h1>
						</div>
						<div >
							{!! $item->content_html !!}
						</div>
						<div class="post_categories">
							@foreach ($item->categories as $category)
								<a href="{{ route('locale.blog.categories.show',['slug'=>$category->category->slug,'locale'=>$locale]) }}" title="@lang('messages.show')">
									<span class="badge badge-info">{{ $category->category->title }}</span>
								</a>
							@endforeach
						</div>
						<div class="post_attr">
							<span class="post_author">
									<a href="{{ route('locale.blog.posts.author',['author_id'=>$item->author->id,'locale'=>$locale]) }}" title="@lang('messages.show')">
										{{ $item->author->name }}
									</a>
							</span>
							<span class="post_date" >
								 <a href="{{ route('locale.blog.posts.date',['date'=> Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y'),'locale'=>$locale]) }}" title="@lang('messages.show')">
									{{ Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y') }}
								</a>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection