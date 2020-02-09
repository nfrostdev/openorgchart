@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    @component('components.form')
        @slot('method', 'POST')
        @slot('action', route('password.update'))
        @slot('submit_text', 'Change Password')

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
    @endcomponent
@endsection
