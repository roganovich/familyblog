<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="imglist row">
			@foreach ($item->images as $img)
				<div class="imgitem col-md-4">
					<div>
						<img src="{{ route('locale.images.thumb',['locale'=>$locale, 'img'=>$img['id'],'width'=>300,'height'=>200]) }}" title="{{ $img['title'] }}" alt="{{ $img['title'] }}" class="img-fluid"/>
					</div>
					<div class="imgitem_delete">
						<a class="btn btn-danger" title="@lang('messages.delete')" href="{{ route('locale.moderate.images.destroy',['locale'=>$locale,'id'=>$img['id']]) }}"><span class="oi oi-trash"></span></a>
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

