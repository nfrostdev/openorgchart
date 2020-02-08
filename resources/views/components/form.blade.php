<div class="columns is-centered">
    <div class="column is-one-quarter">
        <form method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST'  }}" action="{{ $action }}" class="box" {{ isset($callback) ? 'onsubmit=' . $callback . '()' : ''}}>
            @if(strtoupper($method) !== 'GET')
                @csrf
                @method($method)
            @endif
            {{ $slot }}
        </form>
    </div>
</div>
