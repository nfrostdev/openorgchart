@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="columns is-centered">
        <form method="POST" class="column is-one-quarter" action="{{ route('password.update') }}" onsubmit="showSubmitButtonLoading()">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            @component('components.input')
                @slot('id', 'email')
                @slot('label', 'E-Mail Address')
                @slot('type', 'email')
                @slot('required', true)
                @slot('autocomplete', 'email')
                @slot('icon', 'fa-envelope')
                @slot('value', $email ?? old('email'))
            @endcomponent

            @component('components.input')
                @slot('id', 'password')
                @slot('label', 'Password')
                @slot('type', 'password')
                @slot('required', true)
                @slot('autocomplete', 'new-password')
                @slot('icon', 'fa-lock')
            @endcomponent

            @component('components.input')
                @slot('id', 'password_confirmation')
                @slot('label', 'Confirm Password')
                @slot('type', 'password')
                @slot('required', true)
                @slot('autocomplete', 'new-password')
                @slot('icon', 'fa-lock')
            @endcomponent

            <div class="field">
                <div class="control">
                    <button type="submit" id="submit-button" class="button is-fullwidth is-link is-rounded">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
@endsection
