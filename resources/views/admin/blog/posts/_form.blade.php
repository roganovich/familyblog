	<div class="card">
		<div class="card-body">

			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="form-group">
						<label for="title">@lang('messages.title')</label>
						<input type="text"  name="title" class="form-control" value="{{ old('title', $item->title)  }}"/>
					</div>
					<div class="form-group">
						<label for="title">@lang('messages.slug')</label>
						<input type="text" class="form-control" name="slug"  value="{{ old('slug', $item->slug)  }}"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="title">
							@lang('messages.categories_list')
						</label>

						@foreach ($categoryList as $category)
							<div class="form-group form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}"> {{ $category->title }}
								</label>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="form-group">
						<label for="title">@lang('messages.сontent')</label>
						<textarea id="content_html" name="content_html" class="form-control summernote" rows="20">{{ old('content_html', $item->content_html)  }}</textarea>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary"/>@lang('messages.save')</button>
		</div>
	</div>


		<script src="/package/ckeditor/ckeditor.js"></script>


	<script type="text/javascript">
		jQuery(document).ready(function($) {
			CKEDITOR.replace( 'content_html',{});
			//ClassicEditor.create( document.querySelector( '#content_html'));
		});
	</script>

