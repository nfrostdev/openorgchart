@extends('layouts.app')

@section('title', 'Login')

@section('content')
    @component('components.form')
        @slot('method', 'POST')
        @slot('action', 'login')
        @slot('callback', 'showSubmitButtonLoading')

        @component('components.input')
            @slot('id', 'email')
            @slot('label', 'E-Mail Address')
            @slot('type', 'email')
            @slot('required', true)
            @slot('autocomplete', 'email')
            @slot('icon', 'fa-envelope')
        @endcomponent

        @component('components.input')
            @slot('id', 'password')
            @slot('label', 'Password')
            @slot('type', 'password')
            @slot('required', true)
            @slot('autocomplete', 'current-password')
            @slot('icon', 'fa-lock')
        @endcomponent

        <div class="field">
            <div class="control">
                <label class="checkbox" for="remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                    Remember Me
                </label>
            </div>
        </div>

        @component('components.submit-button')
            @slot('text', 'Login')
            @slot('classes', 'is-link')
        @endcomponent

        <div class="field">
            <div class="control">
                @if (Route::has('password.request'))
                    <a class="is-block has-text-centered is-size-7" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    @endcomponent
@endsection
