<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
					@if($item->is_published)
						<div class="alert alert-success" role="alert">
							Опубликовано
						</div>
					@else
						<div class="alert alert-secondary" role="alert">
							Черновик
						</div>
					@endif
					@if($item->exists)
						<div class="form-group">
								<label for="id">@lang('messages.ID')</label>
								<input name="id" disabled class="form-control" value="{{ $item->id }}"/>
						</div>
						<div class="form-group">
								<label for="created_at">@lang('messages.created_at')</label>
								<input type="text" name="created_at" disabled class="form-control" value="{{ $item->created_at }}"/>
						</div>
						<div class="form-group">
								<label for="updated_at">@lang('messages.updated_at')</label>
								<input type="text" name="updated_at" disabled class="form-control" value="{{ $item->updated_at }}"/>
						</div>
						<div class="form-group">
								<label for="deleted_at">@lang('messages.deleted_at')</label>
								<input type="text" name="deleted_at" disabled class="form-control" value="{{ $item->deleted_at }}"/>
						</div>
					<button type="submit" class="btn btn-primary"/>Сохранить</button>
					@if($item->exists)
					@endif
				@endif
			</div>
		</div>
	</div>
</div>