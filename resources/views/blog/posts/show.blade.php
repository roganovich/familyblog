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

						<div class="post_images row justify-content-center">
							@foreach ($item->images as $image)
								<div class="card col-md-4" style="width: 18rem;">
									<a  rel="blog_img_group" data-fancybox="gallery" href="{{ $image['path'] }}">
										<img class="card-img-top img-fluid" title="{{ $image['title'] }}"
											 alt="{{ $image['title'] }}"
											 src="{{ route('locale.images.thumb',['locale'=>$locale, 'img'=>$image['id'],'width'=>300,'height'=>200]) }}"/>
									</a>
									<div class="card-body">
										<p class="card-text">{{$image['title']}}</p>
									</div>
								</div>
							@endforeach
						</div>

						<div class="post_attr">
							<a class="post_avatar_link" href="{{ route('locale.blog.posts.author',['author_id'=>$item->author->id,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->author->name }}">
								<div class="post_author_img" style="background-image: url('{{$item->author->avatar}}')"> </div>
							</a>
							<div class="post_author_name">
								<a href="{{ route('locale.blog.posts.author',['author_id'=>$item->author->id,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->author->name }}">
									{{ $item->author->name }}
								</a>
							</div>
							<div class="post_date" >
								<a href="{{ route('locale.blog.posts.date',['date'=> Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y'),'locale'=>$locale]) }}" title="@lang('messages.show') {{ Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y') }}">
									{{ Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y') }}
								</a>
							</div>
							@if($auth)
								<div class="post_edit">
									<a href="{{ route('locale.moderate.blog.posts.edit',['id'=>$item->id,'locale'=>$locale]) }}" title="@lang('messages.update') {{ $item->title }}">
										<span class="oi oi-pencil"></span>
									</a>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
		<script>
			!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
		</script>
		<script type="text/javascript" src="/package/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
		<script type="text/javascript" src="/package/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo asset('/package/fancybox/jquery.fancybox-1.3.4.css')?>" media="screen" />
		<script type="text/javascript">
			$(document).ready(function() {
				$("a[rel=blog_img_group]").fancybox({
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'titlePosition' 	: 'over',
					'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
						return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
					}
				});
			})
		</script>
@endsection


