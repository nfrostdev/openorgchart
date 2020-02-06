@extends('layouts.app')

@section('title', 'Edit Team: ' . $team->name)

@section('content')
    @component('components.form')
        @slot('method', 'PATCH')
        @slot('action', route('teams.update', ['team' => $team->id]))
        @slot('callback', 'showSubmitButtonLoading')

        @component('components.input')
            @slot('id', 'name')
            @slot('label', 'Team Name')
            @slot('type', 'text')
            @slot('required', true)
            @slot('value', $team->name)
        @endcomponent

        @component('components.input')
            @slot('id', 'department_id')
            @slot('label', 'Department')
            @slot('type', 'select')

            <option value="">None</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ isset($team->department->id) && $department->id === $team->department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        @endcomponent

        @component('components.input')
            @slot('id', 'leader_id')
            @slot('label', 'Team Leader')
            @slot('type', 'select')

            <option value="">None</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ $employee->id === $team->leader_id ? 'selected' : '' }}>
                    {{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->team->name ?? 'No Team Assigned' }}
                </option>
            @endforeach
        @endcomponent

        @component('components.submit-button')
            @slot('text', 'Update')
            @slot('classes', 'is-link')
        @endcomponent
    @endcomponent

    <form method="POST"
          action="{{ route('teams.destroy', ['team' => $team->id]) }}"
          onsubmit="confirmDeleteTeam(event, '{{ $team->name }}')"
          class="section has-text-centered">
        @csrf
        @method('DELETE')
        <button class="button card is-danger" title="Permanently Delete {{ $team->name }}">Permanently Delete</button>
    </form>

    <script>
        function confirmDeleteTeam(event, team) {
            let confirmation = confirm("Are you sure you want to delete " + team + "?\nDeleting this team will delete all employees in it!\nThis action is permanent and cannot be undone!");
            if (!confirmation) {
                event.preventDefault();
            }
        }
    </script>
@endsection
