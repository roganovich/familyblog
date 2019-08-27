@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					@if($item->exists)
						<form method="POST" action="{{ route('locale.admin.blog.categories.update',$item->id, $locale) }}">
							@method('PATCH')
					@else
						<form method="POST" action="{{ route('locale.admin.blog.categories.store', $locale) }}">
					@endif
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
								<div class="col-md-8">
									@include('admin.blog.categories.include.item_main_col')
								</div>
								<div class="col-md-3">
									@include('admin.blog.categories.include.item_add_col')
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
