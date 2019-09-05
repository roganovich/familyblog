@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    {{ Breadcrumbs::render('admin.images.index',['locale'=>$locale]) }}

                    <nav class="navbar">
                        <a class="btn btn-primary" href="{{ route('locale.admin.images.create', $locale) }}">@lang('messages.add')</a>
                    </nav>
                    <div class="card-body">
                        <table class="table table-border-white">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('messages.title')</th>
                                <th>@lang('messages.obj_class')</th>
                                <th>@lang('messages.obj_id')</th>
                                <th>@lang('messages.img_name')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->obj_class }}</td>
                                    <td>{{ $item->obj_id }}</td>
                                    <td>{{ $item->img_name }}</td>
                                    <td>
                                        <a href="{{ route('locale.admin.images.edit',['id'=>$item->id,'locale'=>$locale]) }}" title="@lang('messages.edit')">
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
