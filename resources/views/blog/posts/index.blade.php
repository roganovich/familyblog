@extends('layouts.app')
@section('title', SettingsHelper::getParram('TITLE'))
@section('content')
    @include('blog.posts.list',['items'=>$items])
@endsection


