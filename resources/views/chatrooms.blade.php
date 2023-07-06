@extends('canevas')
@section('title', 'Chatrooms')
@section('content')
@foreach ($channels as $channel)
<a href="{{route('channels.messages', $channel->id)}}" class="channels">{{ $channel->name }}</a>
@endforeach
@endsection