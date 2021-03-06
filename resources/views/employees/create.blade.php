@extends('layouts.app')

@section('title', 'Create an Employee')

@section('content')
    @component('components.form')
        @slot('method', 'POST')
        @slot('action', route('employees.store'))
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
            @slot('id', 'title')
            @slot('label', 'Title')
            @slot('type', 'text')
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'supervisor_id')
            @slot('label', 'Supervisor')
            @slot('type', 'select')

            <option value="">None</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
            @endforeach
        @endcomponent

    @endcomponent
@endsection
