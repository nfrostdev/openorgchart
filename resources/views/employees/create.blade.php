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
            @slot('id', 'department_id')
            @slot('label', 'Department')
            @slot('type', 'select')
            @slot('required', false)

            <option value="">None</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        @endcomponent

        @component('components.input')
            @slot('id', 'supervisor_id')
            @slot('label', 'Supervisor')
            @slot('type', 'select')
            @slot('required', false)

            <option value="">None</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
            @endforeach
        @endcomponent

        @component('components.submit-button')
            @slot('text', 'Create')
            @slot('classes', 'is-link')
        @endcomponent
    @endcomponent
@endsection
