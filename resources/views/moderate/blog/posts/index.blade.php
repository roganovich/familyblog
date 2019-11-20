@extends($layout)
@section('content')

<div class="container">
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

			<nav class="navbar">
				<a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">Добавить</a>
			</nav>
			<div class="card">
				<div class="card-body">
					<table class="table table-border-white">
						<thead>
							<tr>
								<th>#</th>
								<th>Автор</th>
								<th>Категория</th>
								<th>Название</th>
								<th>Опубликован</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($paginator as $item)
							<tr @if (!$item->is_published) style="background-color: #eee" @endif>
								<td>{{ $item->id }}</td>
								<td>{{ $item->author->name }}</td>
								<td>{{ $item->category->title }}</td>
								<td>{{ $item->title }}</td>
								<td>{{ $item->is_published ? \Carbon\Carbon::parse($item->published_at)->format('d.m.Y h:i')  : '' }}</td>
								<td><a href="{{ route('blog.admin.posts.edit',$item->id) }}">Изменить</a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@if( $paginator->total() > $paginator->count() )
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								{{ $paginator->links() }}
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection
