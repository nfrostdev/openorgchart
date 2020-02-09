@extends('layouts.app')

@section('title', 'Departments')

@section('content')
    <p class="content has-text-centered">Departments are the broadest level of organization for your institution.</p>

    @component('components.create-button')
        @slot('route', route('departments.create'))
        @slot('text', 'New Department')
    @endcomponent

    @if($departments->count() > 0)
        @component('components.table')
            @slot('headers', ['ID', 'Name', 'Leader', 'Last Updated'])
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td><a href="{{ route('departments.edit', ['department' => $department->id]) }}" title="Edit {{ $department->name }} Department">{{ $department->name }}</a></td>
                    <td>{{ $department->leader->first_name ?? 'N/A' }} {{ $department->leader->last_name ?? '' }}</td>
                    <td>{{ $department->updated_at }}</td>
                </tr>
            @endforeach
        @endcomponent
        {{ $departments->links() }}
    @endif
@endsection
