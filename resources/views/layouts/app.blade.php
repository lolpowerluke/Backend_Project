<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Backend Project</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script>
        function showCommentForm() {
            document.getElementById("comment-form").style.display = "block";
            document.getElementById("comment-button").style.display = "none";
        }
        function showEditCommentForm() {
            document.getElementById("edit-comment-form").style.display = "block";
            document.getElementById("edit-comment-button").style.display = "none";
            document.getElementById("delete-comment-button").style.display = "none";
        }
        function hideEditCommentForm() {
            document.getElementById("edit-comment-form").style.display = "none";
            document.getElementById("edit-comment-button").style.display = "block";
            document.getElementById("delete-comment-button").style.display = "block";
        }
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">All News</a>
                <a class="navbar-brand text-center" href="{{ route('question.index') }}">All Questions</a>
                @auth
                @if(Auth::user()->admin)
                <a class="navbar-brand text-center" href="{{ route('admin.index') }}">Admin</a>
                @endif
                @endauth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <span id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span> 
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/user/{{ Auth::user()->id }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('user.edit', Auth::user()->id) }}">Edit Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
        @yield('content')
        </main>
    </div>
    <footer>
        <span>Backend Project</span>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('faq') }}">FAQ</a>
    </footer>
</body>
</html>
