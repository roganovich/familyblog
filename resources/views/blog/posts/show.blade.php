@extends('layouts.app')
@section('content')
	<div class="container">
		{{ Breadcrumbs::render('blog.posts.show',['id'=>$item->id,'title'=>$item->title,'locale'=>$locale]) }}
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">

					<div class="card">
					<div class="card-body">
						<div>
								<span>{{ $item->title }}</span>
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

			</div>
		</div>
	</div>
@endsection