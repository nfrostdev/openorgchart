<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.min.css" integrity="sha256-D9M5yrVDqFlla7nlELDaYZIpXfFWDytQtiV+TaH6F1I=" crossorigin="anonymous"/>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>
<header>
    <nav class="navbar is-light" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>

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
                        <a class="navbar-item" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="navbar-item" href="{{ route('departments.index') }}">Departments</a>
                        <a class="navbar-item" href="{{ route('teams.index') }}">Teams</a>
                        <a class="navbar-item" href="{{ route('employees.index') }}">Employees</a>
                        <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
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

                function showSubmitButtonLoading() {
                    document.getElementById('submit-button').classList.add('is-loading')
                }
            </script>
        </div>
    </nav>
    @auth
        <div class="container">
            <div class="box content is-small is-shadowless">
                <div class="level-item has-text-link">
                    <span class="icon">
                        <span class="fas fa-user-circle"></span>
                    </span>
                    <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                </div>
            </div>
        </div>
    @endauth
</header>

<main class="section">
    <div class="container">
        <h1 class="title is-3 has-text-centered">@yield('title')</h1>
        <div class="columns is-centered">
            @yield('content')
        </div>
    </div>
</main>

</body>
</html>
