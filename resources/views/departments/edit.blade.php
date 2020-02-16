@extends('layouts.app')

@section('title', 'Edit Department: ' . $department->name)

@section('content')
    @component('components.form')
        @slot('method', 'PATCH')
        @slot('action', route('departments.update', ['department' => $department]))
        @slot('submit_text', 'Save')

        @component('components.input')
            @slot('id', 'name')
            @slot('label', 'Department Name')
            @slot('type', 'text')
            @slot('value', $department->name)
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'employee_id')
            @slot('label', 'Leader')
            @slot('type', 'select')

            <option value="">None</option>
            @foreach($employees as $leader)
                <option value="{{ $leader->id }}" {{ $department->leader && $department->leader->id === $leader->id ? 'selected' : '' }}>
                    {{ $leader->first_name }} {{ $leader->last_name }}
                </option>
            @endforeach
        @endcomponent
    @endcomponent

    @component('components.delete-button')
        @slot('action', route('departments.destroy', ['department' => $department]))
        @slot('resource_name', $department->name)
    @endcomponent
@endsection
