@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    {{ Breadcrumbs::render('admin.blog.categories.index') }}

                    <nav class="navbar">
                        <a class="btn btn-primary" href="{{ route('admin.blog.categories.create') }}">@lang('messages.add')</a>
                    </nav>
                    <div class="card-body">
                        <table class="table table-border-white">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('messages.title')</th>
                                <th>@lang('messages.slug')</th>
                                <th>@lang('messages.description')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td><a href="{{ route('admin.blog.categories.edit',['id'=>$item->ide]) }}">@lang('messages.edit')</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
