@extends('canevas')
@section('title', 'Login')
@section('content')
    @guest
        <form action="{{route('auth.login')}}" method="post">
            <div class="imgcontainer">
                <img src="/img/logo_avatar.png" alt="Avatar" class="avatar">
            </div>
            @csrf
            <h2>Login</h2>
            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button type="submit" class="button-log">Login</button>
            </div>
        </form>
        <form action="{{route('auth.register')}}" method="post">
            @csrf
            <h2>Register</h2>
            <div class="container">
                <label for="email"><b>Matricule</b></label>
                <input type="text" placeholder="Enter matricule" name="matricule" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
                <button type="submit" class="button-log">Register</button>
            </div>
        </form>
    @endguest
    @auth
        <div>
            <h1>Account information</h1>
            <br>
            <ul>
                <li>Name : {{ Auth::user()->name }}</li>
                <li>Email : {{ Auth::user()->email }}</li>
            </ul>
        </div>
        @if(isset($posts))
            <p>My posts</p><hr>
            <table>
                @foreach($posts as $post)
                    <tr>
                        <th>{{$post->name}}</th>
                        <td><a href="{{route('post.edit', $post->id)}}">Edit</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            test
        @endif
    @endauth
@endsection
