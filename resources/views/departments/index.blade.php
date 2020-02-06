@extends('layouts.app')

@section('title', 'Departments')

@section('content')
    <p class="content has-text-centered">Departments are the broadest level of organization for your institution.</p>
    <div class="content has-text-centered">
        <a href="{{ route('departments.create') }}" class="button card">New Department</a>
    </div>
    @if($departments->count())
        @component('components.table')
            @slot('headers', ['ID', 'Name', 'Leader', 'Teams', 'Created', 'Last Updated', ''])
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td><a href="{{ route('departments.edit', ['department' => $department->id]) }}" title="Edit {{ $department->name }} Department">{{ $department->name }}</a></td>
                    <td>{!! $department->leader->first_name ?? '<strong>No Department Leader</strong>' !!} {{ $department->leader->last_name ?? '' }}</td>
                    <td>{{ $department->teams->count() }}</td>
                    <td>{{ $department->created_at }}</td>
                    <td>{{ $department->updated_at }}</td>
                    <td>
                        <form method="POST"
                              action="{{ route('departments.destroy', ['department' => $department->id]) }}"
                              onsubmit="confirmDeleteDepartment(event, '{{ $department->name }}')"
                              class="is-marginless">
                            @csrf
                            @method('DELETE')
                            <button class="delete is-medium" title="Delete {{ $department->name }} Department"></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endcomponent
        {{ $departments->links() }}
    @endif
@endsection

<script>
    function confirmDeleteDepartment(event, department) {
        let confirmation = confirm("Are you sure you want to delete " + department + "?\nDeleting this department will delete all teams and employees in it!\nThis action is permanent and cannot be undone!");
        if (!confirmation) {
            event.preventDefault();
        }
    }
</script>
