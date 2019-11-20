<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="imglist row">
			@foreach ($item->images as $img)
				<div class="imgitem col-md-4">
					<div>
						<img src="{{$img['path']}}" title="{{$img['title']}}"/>
					</div>
					<div class="imgitem_delete">
						<a class="btn btn-danger" href="{{ route('locale.moderate.images.destroy',['locale'=>$locale,'id'=>$img['id']]) }}">Удалить</a>
					</div>

            </div>
@endforeach
		</div>
		<div class="form-group">
			<label for="slug">@lang('messages.images')</label>
			<input type="file" class="form-control" name="files[]"  value="" multiple/>
		</div>
	</div>
</div>

