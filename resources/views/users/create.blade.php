@extends('layouts.app')

@section('title', 'Create a User')

@section('content')
    @component('components.form')
        @slot('method', 'POST')
        @slot('action', route('users.store'))
        @slot('submit_text', 'Create')

        @component('components.input')
            @slot('id', 'first_name')
            @slot('label', 'First Name')
            @slot('type', 'text')
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'last_name')
            @slot('label', 'Last Name')
            @slot('type', 'text')
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'email')
            @slot('label', 'E-Mail Address')
            @slot('type', 'email')
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'password')
            @slot('label', 'Password')
            @slot('type', 'password')
            @slot('required', true)
        @endcomponent

        <div class="field">
            <strong class="help is-info has-text-centered" role="alert">User can change their password after login.</strong>
        </div>

        @component('components.input')
            @slot('id', 'role_id')
            @slot('label', 'Role')
            @slot('type', 'select')

            <option value="">User</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id') && $role->id === old('role_id') ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        @endcomponent
    @endcomponent
@endsection
