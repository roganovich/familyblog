@extends($layout)
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					@if($item->exists)
						<form method="POST" action="{{ route('locale.moderate.blog.categories.update',['id'=>$item->id,'locale'=>$locale]) }}" enctype="multipart/form-data">
					@else
						<form method="POST" action="{{ route('locale.moderate.blog.categories.store') }}" enctype="multipart/form-data">
					@endif
					@csrf
						<div class="container">
							@if($errors->any())
								@foreach($errors->all() as $errorTxt)
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  	{{ $errorTxt }}
								  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    	<span aria-hidden="true">&times;</span>
						  			</button>
								</div>
								@endforeach
							@endIf

							<div class="row justify-content-center">
								<div class="col-md-8">
									@include('moderate.blog.categories.include.item_main_col')
									@include('moderate.blog.categories.include.item_images')
								</div>
								<div class="col-md-3">
									@include('moderate.blog.categories.include.item_add_col')
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
