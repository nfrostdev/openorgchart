@extends('layouts.app')

@section('title', 'Editing User: ' . $user->first_name . ' ' . $user->last_name)

@section('content')
    @component('components.form')
        @slot('method', 'PATCH')
        @slot('action', route('users.update', ['user' => $user]))
        @slot('submit_text', 'Save')

        @component('components.input')
            @slot('id', 'first_name')
            @slot('label', 'First Name')
            @slot('type', 'text')
            @slot('required', true)
            @slot('value', $user->first_name)
        @endcomponent

        @component('components.input')
            @slot('id', 'last_name')
            @slot('label', 'Last Name')
            @slot('type', 'text')
            @slot('required', true)
            @slot('value', $user->last_name)
        @endcomponent

        @component('components.input')
            @slot('id', 'email')
            @slot('label', 'E-Mail Address')
            @slot('type', 'email')
            @slot('required', true)
            @slot('value', $user->email)
        @endcomponent

        @component('components.input')
            @slot('id', 'password')
            @slot('label', 'Password')
            @slot('type', 'password')
            @slot('required', false)
        @endcomponent

        @if($user->id !== 1 && Auth::user()->hasRole('Administrator'))
            @component('components.input')
                @slot('id', 'role_id')
                @slot('label', 'Role')
                @slot('type', 'select')

                <option value="">User</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ isset($user->role->id) && $role->id === $user->role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            @endcomponent
        @endif
    @endcomponent

    @if($user->id !== 1 && $user->id !== Auth::user()->id)
        @component('components.delete-button')
            @slot('action', route('users.destroy', ['user' => $user]))
            @slot('resource_name', $user->first_name . ' ' . $user->last_name)
        @endcomponent
    @endif
@endsection
