@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    {{ Breadcrumbs::render('admin.blog.categories.index',['locale'=>$locale]) }}

                    <nav class="navbar">
                        <a class="btn btn-primary" href="{{ route('locale.admin.blog.categories.create', $locale) }}">@lang('messages.add')</a>
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
                                    <td><a href="{{ route('locale.admin.blog.categories.edit',['id'=>$item->id,'locale'=>$locale]) }}">@lang('messages.edit')</a></td>
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
