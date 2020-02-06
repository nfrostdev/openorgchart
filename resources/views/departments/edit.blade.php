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
                <option value="{{ $employee->id }}" {{ $department->leader_id === $employee->id ? 'selected' : '' }}>
                    {{ $employee->first_name }} {{ $employee->last_name }} (ID #{{ $employee->id }})
                </option>
            @endforeach
        @endcomponent

        @component('components.submit-button')
            @slot('text', 'Update')
            @slot('classes', 'is-link')
        @endcomponent
    @endcomponent

    <form method="POST"
          action="{{ route('departments.destroy', ['department' => $department->id]) }}"
          onsubmit="confirmDeleteDepartment(event, '{{ $department->name }}')"
          class="section has-text-centered">
        @csrf
        @method('DELETE')
        <button class="button card is-danger" title="Permanently Delete {{ $department->name }} Department">Permanently Delete</button>
    </form>

    <script>
        function confirmDeleteDepartment(event, department) {
            let confirmation = confirm("Are you sure you want to delete " + department + "?\nDeleting this department will delete all teams and employees in it!\nThis action is permanent and cannot be undone!");
            if (!confirmation) {
                event.preventDefault();
            }
        }
    </script>
@endsection
