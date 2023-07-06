@extends('canevas')
@section('title', 'Create a post')
@section('content')
    @auth
        @include('form')
    @endauth
    @guest
        You have to be logged to create a new post.
    @endguest
@endsection