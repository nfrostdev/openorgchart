<div class="columns is-centered">
    <form method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST'  }}" action="{{ $action }}" class="column is-one-quarter" {{ isset($callback) ? 'onsubmit=' . $callback . '()' : ''}}>
        @if(strtoupper($method) !== 'GET')
            @csrf
            @method($method)
        @endif
        {{ $slot }}
    </form>
</div>
