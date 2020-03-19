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

		@if($item->is_published)
			<div class="alert alert-success" role="alert">
				Опубликовано
			</div>
		@else
			<div class="alert alert-secondary" role="alert">
				Черновик
			</div>
		@endif

		<div class="form-group">
				<label for="title">@lang('messages.title')</label>
				<input type="text"  name="title" class="form-control" value="{{ old('title', $item->title)  }}"/>
		</div>
		<div class="form-group">
				<label for="slug">@lang('messages.slug')</label>
				<input type="text" class="form-control" name="slug"  value="{{ old('slug', $item->slug)  }}"/>
		</div>
		<div class="form-group">
			<label for="content_html">@lang('messages.description')</label>
			<textarea name="description" class="form-control">{{ old('description', $item->description)  }}</textarea>
		</div>
		<div class="form-check">
			<label for="is_published" class="form-check-label">
			<input type="hidden" name="is_published" value="0">
			<input type="checkbox" name="is_published" class="form-check-input" value="1" @if($item->is_published) checked @endif>
			Опубликован?</label>
		</div>
	</div>
</div>

