@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="columns is-centered">
        <form method="POST" action="{{ route('login') }}" class="column is-one-quarter" onsubmit="showSubmitButtonLoading()">
            @csrf
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

            <div class="field">
                <div class="control">
                    <button type="submit" id="submit-button" class="button is-fullwidth is-link is-rounded">Login</button>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    @if (Route::has('password.request'))
                        <a class="is-block has-text-centered is-size-7" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
