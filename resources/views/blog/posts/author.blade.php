@extends('layouts.app')
@section('title', __('messages.authortitle') .' '. $author->name)
@section('content')
    @include('blog.posts.list',['items'=>$items])
@endsection


