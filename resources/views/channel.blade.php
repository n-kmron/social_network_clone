@extends('canevas')
@section('title', 'Channel')
@section('content')
@auth
@if(empty($messages[0]->name))
<p>This chat is empty, post a new message to start it !</p>
@else
<h1>{{ $messages[0]->name }}</h1>
<h3>{{ $messages[0]->topic }}</h3>
<hr>
@foreach ($messages as $message)
<div class="message">
          <h3 class="msgContent">{{ $message->username }} - <span class="dateMessage">{{ $message->updated_at }}</span></h3>
          <p class="msgContent">{{ $message->content }}</p>
</div>
@endforeach
<hr>
<h3 class="msgContent">New message</h3>
<form method="POST" action="{{route('channels.messages', $messages[0]->id)}}">
          @csrf
          <textarea name="message" rows="4" cols="50" required></textarea>
          <br>
          <button type="submit">Publish</button>
</form>
<br>
@endif
@endauth
@guest
<p>You have to be <a href="{{route('auth.login')}}" class="backLink">logged</a> to watch this discussion</p>
@endguest
<a href="{{route('chatrooms')}}" class="backLink">Back to chatrooms</a>
@endsection
