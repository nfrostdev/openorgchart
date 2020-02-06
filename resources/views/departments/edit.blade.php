@extends('layouts.app')

@section('title', 'Edit Department: ' . $department->name)

@section('content')
    @component('components.form')
        @slot('method', 'PATCH')
        @slot('action', route('departments.update', ['department' => $department->id]))
        @slot('callback', 'showSubmitButtonLoading')

        @component('components.input')
            @slot('id', 'name')
            @slot('label', 'Department Name')
            @slot('type', 'text')
            @slot('value', $department->name)
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'leader_id')
            @slot('label', 'Department Leader')
            @slot('type', 'select')

            <option value="">None</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ $department->leader_id === $employee->id || $department->leader_id === old('leader_id') ? 'selected' : '' }}>
                    {{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->team->name ?? 'No Team Assigned' }}
                </option>
            @endforeach
        @endcomponent

        @component('components.submit-button')
            @slot('text', 'Update')
            @slot('classes', 'is-link')
        @endcomponent
    @endcomponent
@endsection
