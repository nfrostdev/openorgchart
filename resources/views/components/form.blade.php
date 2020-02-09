<div class="columns is-centered">
    <div class="column is-one-quarter">
        <form method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST'  }}" action="{{ $action }}" class="box" onsubmit="showSubmitButtonLoading()">
            @if(strtoupper($method) !== 'GET')
                @csrf
                @method($method)
            @endif

            {{ $slot }}

            <div class="field">
                <div class="control">
                    <button type="submit" id="submit-button" class="button card is-fullwidth is-rounded is-link">{{ $submit_text ?? 'Submit' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
