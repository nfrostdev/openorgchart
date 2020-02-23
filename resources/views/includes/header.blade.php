@php
    // TODO: Properly abstract this.
    // TODO: Reserve as variable so this complex evaluation isn't ran every render of the header.
    function getContrastColor($hexColor) {
            // hexColor RGB
            $R1 = hexdec(substr($hexColor, 1, 2));
            $G1 = hexdec(substr($hexColor, 3, 2));
            $B1 = hexdec(substr($hexColor, 5, 2));

            // Black RGB
            $blackColor = "#000000";
            $R2BlackColor = hexdec(substr($blackColor, 1, 2));
            $G2BlackColor = hexdec(substr($blackColor, 3, 2));
            $B2BlackColor = hexdec(substr($blackColor, 5, 2));

             // Calc contrast ratio
             $L1 = 0.2126 * pow($R1 / 255, 2.2) +
                   0.7152 * pow($G1 / 255, 2.2) +
                   0.0722 * pow($B1 / 255, 2.2);

            $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
                  0.7152 * pow($G2BlackColor / 255, 2.2) +
                  0.0722 * pow($B2BlackColor / 255, 2.2);

            $contrastRatio = 0;
            if ($L1 > $L2) {
                $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
            } else {
                $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
            }

            // If contrast is more than 5, return black color
            if ($contrastRatio > 5) {
                return '#000000';
            } else {
                // if not, return white color.
                return '#FFFFFF';
            }
    }

    if(env('SITE_COLOR')) {
        $text_color = getContrastColor(env('SITE_COLOR'));
    }
@endphp

@include('includes.site-settings')

<header>
    {{-- TODO: Handle dark colors being selected as the site color, make text black or white according to contrast. --}}
    <nav class="navbar card {{ $text_color === '#FFFFFF' ? 'is-dark' : 'is-light' }}" style="background-color: {{ env('SITE_COLOR') }}" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/') }}">
                    {{-- TODO: Swappable logo to company logo. --}}
                    <img alt="Open Org Chart Logo" src="{{ asset('images/vector/OOC_Logo_White.svg') }}" class="navbar-logo">
                    <span>{{ env('SITE_TITLE', '') }}</span>
                </a>
                <a role="button" id="primary-burger" class="navbar-burger" aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="primary-menu" class="navbar-menu">
                <div class="navbar-end">
                    <hr class="navbar-divider">
                    @guest
                        <a class="navbar-item" href="{{ route('login') }}">{{ __('Login') }}</a>

                        @if (Route::has('register'))
                            <a class="navbar-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        @if(Auth::user()->hasRole('Administrator') || Auth::user()->hasRole('Editor'))
                            @component('components.navbar-item')
                                @slot('route', 'departments.index')
                                @slot('icon', 'sitemap')
                                @slot('text', 'Departments')
                            @endcomponent

                            @component('components.navbar-item')
                                @slot('route', 'employees.index')
                                @slot('icon', 'users')
                                @slot('text', 'Employees')
                            @endcomponent
                        @endif

                        @if(Auth::user()->hasRole('Administrator'))
                            @component('components.navbar-item')
                                @slot('route', 'users.index')
                                @slot('icon', 'user-shield')
                                @slot('text', 'Users')
                            @endcomponent

                            @component('components.navbar-item')
                                @slot('route', 'settings.index')
                                @slot('icon', 'cog')
                                @slot('text', 'Site Settings')
                            @endcomponent
                        @endif

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
        </div>
    </nav>
    @auth
        <div class="container">
            <div class="box content is-small is-shadowless has-background-light">
                <div class="level-item has-text-link">
                    <span class="icon">
                        <span class="fas fa-user-circle"></span>
                    </span>
                    <a href="{{ route('users.edit', ['user' => Auth::user()]) }}" class="is-link">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                </div>
            </div>
        </div>
    @endauth
</header>
