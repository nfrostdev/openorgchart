@extends('layouts.app')

@section('title', 'Create an Employee')

@section('content')
    @component('components.form')
        @slot('method', 'POST')
        @slot('action', route('employees.store'))
        @slot('callback', 'showSubmitButtonLoading')

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
            @slot('id', 'title')
            @slot('label', 'Title')
            @slot('type', 'text')
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'team_id')
            @slot('label', 'Team')
            @slot('type', 'select')

            <option value="">None</option>
            @foreach($teams as $team)
                <option value="{{ $team->id }}" {{ old('team_id') && $team->id === old('team_id') ? 'selected' : '' }}>
                    {{ $team->name }} ({{ $team->department->name ?? 'No Department' }})
                </option>
            @endforeach
        @endcomponent

        @component('components.submit-button')
            @slot('text', 'Create')
            @slot('classes', 'is-link')
        @endcomponent
    @endcomponent
@endsection
