<div class="row justify-content-center">
	<div class="col-md-12">
		@if($errors->any())
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  	{{ $errors->first() }}
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
	  			</button>
			</div>
		@endIf

		@if(session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session()->get('success') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endIf

		<div class="card">
			<div class="card-body">
				<div class="form-group">
						<label for="title">Title</label>
						<input type="text"  name="title" class="form-control" value="{{ old('title', $item->title)  }}"/>
				</div>
				<div class="form-group">
						<label for="title">Slug</label>
						<input type="text" class="form-control" name="slug"  value="{{ old('slug', $item->slug)  }}"/>
				</div>
				<div class="form-group">
						<label for="parent_id">Parent_id</label>
						<select class="form-control" name="parent_id">
							@foreach ($categoryList as $category)
								<option value="{{ $category->id }}" @if ($category->id == $item->parent_id) selected @endif>{{ $category->id_title }}</option>
							@endforeach
						</select>
				</div>
				<div class="form-group">
						<label for="title">Description</label>
						<textarea name="description" class="form-control">{{ old('description', $item->description)  }}</textarea>
				</div>
			</div>
		</div>

	</div>
</div>
