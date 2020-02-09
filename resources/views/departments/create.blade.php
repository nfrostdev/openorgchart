@extends('layouts.app')

@section('title', 'Create a Department')

@section('content')
    @component('components.form')
        @slot('method', 'POST')
        @slot('action', route('departments.store'))
        @slot('submit_text', 'Create')

        @component('components.input')
            @slot('id', 'name')
            @slot('label', 'Department Name')
            @slot('type', 'text')
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'employee_id')
            @slot('label', 'Leader')
            @slot('type', 'select')

            <option value="">None</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }} - #{{ $employee->id }}</option>
            @endforeach
        @endcomponent
    @endcomponent
@endsection
