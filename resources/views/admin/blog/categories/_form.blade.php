	<div class="card">
		<div class="card-body">
			<div class="form-group">
					<label for="title">@lang('messages.title')</label>
					<input type="text"  name="title" class="form-control" value="{{ old('title', $item->title)  }}"/>
			</div>
			<div class="form-group">
					<label for="title">@lang('messages.slug')</label>
					<input type="text" class="form-control" name="slug"  value="{{ old('slug', $item->slug)  }}"/>
			</div>
			<div class="form-group">
					<label for="title">@lang('messages.description')</label>
					<textarea name="description" class="form-control">{{ old('description', $item->description)  }}</textarea>
			</div>

			<button type="submit" class="btn btn-primary"/>@lang('messages.save')</button>
		</div>
	</div>

