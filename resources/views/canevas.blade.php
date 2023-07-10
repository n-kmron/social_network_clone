<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Cameron Noupoué">
    <meta name="keywords" content="Cameron,Noupoué,Site Personnel, Blog">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Polices -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Roboto:wght@100;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <link rel="stylesheet" type="text/css" href="/styles/social.css">
    <script defer src="script/social.js"></script>
</head>
@php
    $routeName = request()->route()->getName();
@endphp
<body>
    <header class="topbar">
        <a href="{{route('index')}}" class="topbar-logo">Network</a>
        <nav class="topbar-nav">
            <a href="{{route('auth.login')}}" @class(['active' => str_starts_with($routeName, 'auth.')])>@auth My account @endauth @guest Login @endguest</a>
        </nav>
    </header>
    <div class="container site">
        <nav class="sidebar">
            <a href="{{route('index')}}" @class(['sidebar-home', 'active' => str_starts_with($routeName, 'index')])>News</a>
            <a href="{{route('chatrooms')}}" @class(['sidebar-messages', 'active' => str_starts_with($routeName, 'chatrooms')])>Chatrooms</a>
            <a href="#" @class(['sidebar-events', 'active' => str_starts_with($routeName, 'events.')])>Events</a>
            <a href="#" @class(['sidebar-amis', 'active' => str_starts_with($routeName, 'friends.')])>Friends</a>
        </nav>
        <main class="main">
            @yield('content')
        </main>
        <aside class="aside">
            <article class="card">
                <header class="card-header card-header-avatar">
                    <section>
                        <img src="/img/icons/avatar.png" width="45" height="45" class="card-avatar">
                    </section>
                    <section>
                        @auth
                        <div class="card-title">{{ Auth::user()->name }}</div>
                        <div class="card-date">Registered since {{Auth::user()->created_at}}</div>
                        <form method="get" action="{{route('post.create')}}">
                            @csrf
                            <button type="submit">New post</button>
                        </form>
                        <form method="POST" action="{{route('auth.logout')}}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>

                        @endauth
                        @guest
                        <div class="card-title">As a guest</div>
                        @endguest
                    </section>
                </header>
                <div class="card-body">
                    <p>
                        @guest
                        <a href="{{route('auth.login')}}">Login/Sign Up</a>.
                        @endguest
                    </p>
                </div>
            </article>
            <div class="sidebar-title">Suggestion</div>
            <div class="friends-list">
                <div class="friend">
                    <img src="https://via.placeholder.com/73x73">
                    <div class="friend-body">
                        <a href="#" class="friend-name">John Doe</a>
                        <div class="friend-connections">15 amis communs</div>
                        <a href="#" class="friend-add">Ajouter en amis</a>
                    </div>
                </div>
                <div class="friend">
                    <img src="https://via.placeholder.com/73x73">
                    <div class="friend-body">
                        <a href="#" class="friend-name">Ayoub Nedjar</a>
                        <div class="friend-connections">2 amis communs</div>
                        <a href="#" class="friend-add">Ajouter en amis</a>
                    </div>
                </div>
                <div class="friend">
                    <img src="https://via.placeholder.com/73x73">
                    <div class="friend-body">
                        <a href="#" class="friend-name">Nabil Khdim</a>
                        <div class="friend-connections">31 amis communs</div>
                        <a href="#" class="friend-add">Ajouter en amis</a>
                    </div>
                </div>
                <div class="friend">
                    <img src="https://via.placeholder.com/73x73">
                    <div class="friend-body">
                        <a href="#" class="friend-name">Reda Belkhiri</a>
                        <div class="friend-connections">4 amis communs</div>
                        <a href="#" class="friend-add">Ajouter en amis</a>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <footer>

    </footer>
</body>

</html>
