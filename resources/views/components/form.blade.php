<div class="columns is-centered">
    <form method="{{ $method }}" action="{{ route($action) }}" class="column is-one-quarter" {{ isset($callback) ? 'onsubmit=' . $callback . '()' : ''}}>
        @if(strtoupper($method) === 'POST')
            @csrf
        @endif
        {{ $slot }}
    </form>
</div>
