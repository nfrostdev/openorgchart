<a class="navbar-item {{ Route::currentRouteName() === $route ? 'is-active' : '' }}" href="{{ route($route) }}">
    <span class="icon is-size-7">
        <span class="fas fa-{{ $icon }}"></span>
    </span>
    <span>{{ $text }}</span>
</a>
