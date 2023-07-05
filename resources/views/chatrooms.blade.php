@extends('canevas')
@section('title', 'Chatrooms')
@section('content')
@foreach ($channels as $channel)
<a href="/channels/{{ $channel->id }}/messages" class="channels">{{ $channel->name }}</a>
@endforeach
@endsection