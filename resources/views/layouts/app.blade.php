<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.min.css" integrity="sha256-D9M5yrVDqFlla7nlELDaYZIpXfFWDytQtiV+TaH6F1I=" crossorigin="anonymous"/>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>
<header class="container">
    <nav class="navbar" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item subtitle" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>

            <a role="button" id="primary-burger" class="navbar-burger" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="primary-menu" class="navbar-menu">
            <div class="navbar-end">
                @guest
                    <a class="navbar-item" href="{{ route('login') }}">{{ __('Login') }}</a>

                    @if (Route::has('register'))
                        <a class="navbar-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            {{ Auth::user()->email }}
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
        <script>
            const burger = document.getElementById('primary-burger');
            const menu = document.getElementById('primary-menu');

            function togglePrimaryMenu() {
                burger.classList.toggle('is-active');
                burger.setAttribute('aria-expanded', burger.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
                menu.classList.toggle('is-active');
            }

            burger.addEventListener('click', togglePrimaryMenu);
        </script>
    </nav>
</header>

<main class="container">
    @yield('content')
</main>

</body>
</html>
