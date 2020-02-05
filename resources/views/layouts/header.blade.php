<header>
    <nav class="navbar is-dark card" aria-label="main navigation">
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
                @auth
                    <div class="navbar-start">
                        @component('components.navbar-item')
                            @slot('route', 'departments.index')
                            @slot('icon', 'sitemap')
                            @slot('text', 'Departments')
                        @endcomponent

                        @component('components.navbar-item')
                            @slot('route', 'teams.index')
                            @slot('icon', 'circle-notch')
                            @slot('text', 'Teams')
                        @endcomponent

                        @component('components.navbar-item')
                            @slot('route', 'employees.index')
                            @slot('icon', 'users')
                            @slot('text', 'Employees')
                        @endcomponent
                    </div>
                @endauth
                <div class="navbar-end">
                    <hr class="navbar-divider">
                    @guest
                        <a class="navbar-item" href="{{ route('login') }}">{{ __('Login') }}</a>

                        @if (Route::has('register'))
                            <a class="navbar-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        @component('components.navbar-item')
                            @slot('route', 'dashboard')
                            @slot('icon', 'home')
                            @slot('text', 'Dashboard')
                        @endcomponent

                        @component('components.navbar-item')
                            @slot('route', 'users.index')
                            @slot('icon', 'user-shield')
                            @slot('text', 'Users')
                        @endcomponent

                        <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon is-size-7">
                                <span class="fas fa-sign-out-alt"></span>
                            </span>
                            <span>Logout</span>
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
            <div class="box content is-small is-shadowless has-background-light">
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
