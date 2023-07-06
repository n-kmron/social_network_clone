@extends('canevas')
@section('title', 'Edit a post')
@section('content')
    @auth
        @include('form')
    @endauth
    @guest
        You have to be logged to create a new post.
    @endguest
@endsection