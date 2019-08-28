@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					{{ Breadcrumbs::render('admin.blog.posts.edit',['id'=>$item->id,'title'=>$item->title,'locale'=>$locale]) }}
					<div class="card-body">
							<form method="POST" action="{{ route('locale.admin.blog.posts.update',['id'=>$item->id,'locale'=>$locale]) }}">
								@method('PATCH')
								@csrf
								<div class="container">

									@if($errors->any())
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											{{ $errors->first() }}
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									@endIf

									<div class="row justify-content-center">
										<div class="col-md-12">
											@include('admin.blog.posts._form')
											@include('admin.blog.posts.include.item_add_col')
										</div>
									</div>
								</div>
							</form>
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection