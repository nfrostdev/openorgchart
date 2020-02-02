@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" class="column is-one-quarter" action="{{ route('password.email') }}">
        @csrf

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
@endsection
