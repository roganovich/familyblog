<div class="row justify-content-center">
	<div class="col-md-12">
		@if(session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session()->get('success') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endIf

		@if ($errors->any())
			<div class="alert alert-danger inline-block">
				<ul>
					@foreach ($errors->get('name') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<div class="form-group">
				<label for="title">@lang('messages.title')</label>
				<input type="text"  name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', $item->title)  }}"/>
				@if ($errors->has('title'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('title') }}</strong>
					</span>
				@endif
		</div>
		<div class="form-group">
				<label for="slug">@lang('messages.slug')</label>
				<input type="text" class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug"  value="{{ old('slug', $item->slug)  }}"/>
				@if ($errors->has('slug'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('slug') }}</strong>
					</span>
				@endif
		</div>
		<div class="form-group">
			<label for="content_html">@lang('messages.description')</label>
			<textarea name="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description', $item->description)  }}</textarea>
			@if ($errors->has('description'))
				<span class="invalid-feedback">
						<strong>{{ $errors->first('description') }}</strong>
					</span>
			@endif
		</div>
		<div class="form-check">
			<label for="is_published" class="form-check-label">
			<input type="hidden" name="is_published" value="0">
			<input type="checkbox" name="is_published" class="form-check-input" value="1" @if($item->is_published) checked @endif>
			Опубликован?</label>
		</div>
	</div>
</div>

