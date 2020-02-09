@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    @component('components.form')
        @slot('method', 'POST')
        @slot('action', route('password.email'))
        @slot('submit_text', 'Send Password Reset Link')

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
    @endcomponent
@endsection
