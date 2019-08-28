@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    {{ Breadcrumbs::render('admin.blog.posts.index',['locale'=>$locale]) }}

                    <nav class="navbar">
                        <a class="btn btn-primary" href="{{ route('locale.admin.blog.posts.create', $locale) }}">@lang('messages.add')</a>
                    </nav>
                    <div class="card-body">
                        <table class="table table-border-white">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('messages.title')</th>
                                <th>@lang('messages.category')</th>
                                <th>@lang('messages.updated_at')</th>
                                <th>@lang('messages.is_published')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        @foreach ($item->categories as $category)
                                            <span class="badge badge-info">{{ $category->category->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>{{ $item->is_published }}</td>
                                    <td>
                                        <a href="{{ route('locale.admin.blog.posts.edit',['id'=>$item->id,'locale'=>$locale]) }}" title="@lang('messages.edit')">
                                            <span class="oi oi-pencil"></span>
                                        </a>
                                    </td>
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
