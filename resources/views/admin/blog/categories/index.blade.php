@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar">
                    <a class="btn btn-primary" href="{{ route('admin.blog.categories.create') }}">@lang('messages.add')</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-border-white">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Slug</th>
                                <th>Родитель</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td  @if (in_array($item->parent_id,[0,1])) style="color:#ccc"  @endif>
                                        {{--{{ optional($item->parentCategory)->title  }}--}}
                                        {{--{{
                                            $item->parentCategory->title ?? ($item->parent_id === \App\Models\BlogCategory::ROOT ? 'Корень':'?')
                                        }}--}}
                                        {{$item->parentTitle}}
                                    </td>
                                    <td><a href="{{ route('admin.blog.categories.edit',$item->id) }}">Изменить</a></td>
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
