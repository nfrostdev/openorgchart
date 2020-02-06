@extends('layouts.app')

@section('title', 'Create a Department')

@section('content')
    @component('components.form')
        @slot('method', 'POST')
        @slot('action', route('departments.store'))
        @slot('callback', 'showSubmitButtonLoading')

        @component('components.input')
            @slot('id', 'name')
            @slot('label', 'Department Name')
            @slot('type', 'text')
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'leader_id')
            @slot('label', 'Department Leader')
            @slot('type', 'select')

            <option value="">None</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ old('leader_id') && $employee->id === old('leader_id') ? 'selected' : '' }}>
                    {{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->team->name ?? 'No Team Assigned' }}
                </option>
            @endforeach
        @endcomponent

        @component('components.submit-button')
            @slot('text', 'Create')
            @slot('classes', 'is-link')
        @endcomponent
    @endcomponent
@endsection
