@extends('layouts.app')
@section('title', __('messages.datetitle') .' '. $date )
@section('content')
    @include('blog.posts.list',['items'=>$items])
@endsection
