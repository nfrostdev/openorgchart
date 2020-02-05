@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    @component('components.form')
        @slot('method', 'POST')
        @slot('action', 'password.email')
        @slot('callback', 'showSubmitButtonLoading')

        @if (session('status'))
            <div class="message is-success" role="alert">
                <div class="message-body is-size-7">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @component('components.input')
            @slot('id', 'email')
            @slot('label', 'E-Mail Address')
            @slot('type', 'email')
            @slot('required', true)
            @slot('autocomplete', 'email')
            @slot('icon', 'fa-envelope')
        @endcomponent

        @component('components.submit-button')
            @slot('text', 'Send Password Reset Link')
            @slot('classes', 'is-warning')
        @endcomponent
    @endcomponent
@endsection
