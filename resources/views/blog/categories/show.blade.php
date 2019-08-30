@extends('layouts.app')
@section('content')
	<div class="container">
		{{ Breadcrumbs::render('blog.categories.show',['slug'=>$item->slug,'title'=>$item->title,'locale'=>$locale]) }}
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">

					<div class="card">
					<div class="card-body">
						<div>
								<h1>{{ $item->title }}</h1>
						</div>

							@if($itemPosts)
								<div class="row justify-content-center">
									@foreach ($itemPosts as $item)

										<div class="col-md-4 introitem">
											<div class="card">
												<div class="card-body">
													<div>
														<a href="{{ route('locale.blog.posts.show',['slug'=>$item->post->slug,'locale'=>$locale]) }}" title="@lang('messages.show')">
															<h3>{{ $item->post->title }}</h3>
														</a>
													</div>
													<div class="bodyItem">
														<span>{!! $item->post->intro_html !!}</span>
													</div>
													<div>
														<span>{{ $item->post->author->name }}</span>

														<span>{{ $item->post->updated_at }}</span>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							@endif;
						<div>
							<span>{{ $item->updated_at }}</span>
						</div>
					</div>
				</div>
				</div>

			</div>
		</div>
	</div>
@endsection

