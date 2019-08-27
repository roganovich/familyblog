<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
					<button type="submit" class="btn btn-primary"/>Сохранить</button>
			</div>
		</div>
	</div>
</div>
@if($item->exists)
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
						<div class="form-group">
								<label for="id">ID</label>
								<input name="id" disabled class="form-control" value="{{ $item->id }}"/>
						</div>
						<div class="form-group">
								<label for="created_at">created_at</label>
								<input type="text" name="created_at" disabled class="form-control" value="{{ $item->created_at }}"/>
						</div>
						<div class="form-group">
								<label for="updated_at">updated_at</label>
								<input type="text" name="updated_at" disabled class="form-control" value="{{ $item->updated_at }}"/>
						</div>
						<div class="form-group">
								<label for="deleted_at">deleted_at</label>
								<input type="text" name="deleted_at" disabled class="form-control" value="{{ $item->deleted_at }}"/>
						</div>

				</div>
			</div>
		</div>
	</div>
@endif
