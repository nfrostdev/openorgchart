@extends('layouts.app')

@section('title', 'Edit Employee: ' . $employee->first_name . ' ' . $employee->last_name)

@section('content')
    @component('components.form')
        @slot('method', 'PATCH')
        @slot('action', route('employees.update', ['employee' => $employee->id]))
        @slot('submit_text', 'Save')

        @component('components.input')
            @slot('id', 'first_name')
            @slot('label', 'First Name')
            @slot('type', 'text')
            @slot('required', true)
            @slot('value', $employee->first_name)
        @endcomponent

        @component('components.input')
            @slot('id', 'last_name')
            @slot('label', 'Last Name')
            @slot('type', 'text')
            @slot('required', true)
            @slot('value', $employee->last_name)
        @endcomponent

        @component('components.input')
            @slot('id', 'title')
            @slot('label', 'Title')
            @slot('type', 'text')
            @slot('required', true)
            @slot('value', $employee->title)
        @endcomponent

        @component('components.input')
            @slot('id', 'supervisor_id')
            @slot('label', 'Supervisor')
            @slot('type', 'select')

            <option value="">None</option>
            @php
                // Get a list of disallowed supervisors from this department.
                $disallowed_supervisor_ids = \App\Department::recursiveEmployeeCheck($employee)->map(function($employee) {
                    return $employee->id;
                })->toArray();

                // Filter the employees to see who is assignable.
                $supervisors = $employees->map(function($supervisor) use($disallowed_supervisor_ids){
                    return !in_array($supervisor->id, $disallowed_supervisor_ids) ? $supervisor : null;
                })->reject(function($employee) {
                    return $employee === null;
                });
            @endphp
            @foreach($supervisors as $supervisor)
                <option value="{{ $supervisor->id }}" {{ isset($employee->supervisor->id) && $employee->supervisor->id === $supervisor->id ? 'selected' : '' }}>
                    {{ $supervisor->first_name }} {{ $supervisor->last_name }}
                </option>
            @endforeach
        @endcomponent

    @endcomponent

    @component('components.delete-button')
        @slot('action', route('employees.destroy', ['employee' => $employee->id]))
        @slot('resource_name', $employee->first_name . ' ' .$employee->last_name)
    @endcomponent
@endsection
