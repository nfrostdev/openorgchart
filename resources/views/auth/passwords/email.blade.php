@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="columns is-centered">
        <form method="POST" class="column is-one-quarter" action="{{ route('password.email') }}" onsubmit="showSubmitButtonLoading()">
            @csrf

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

            <button type="submit" id="submit-button" class="button is-warning is-fullwidth is-rounded">Send Password Reset Link</button>
        </form>
    </div>
@endsection
