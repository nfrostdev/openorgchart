@extends('layouts.app')

@section('title', 'Departments')

@section('content')
    <p class="content has-text-centered">Departments are the broadest level of organization for your institution.</p>
    @if($departments->count())
        @component('components.table')
            @slot('headers', ['ID', 'Name', 'Teams', 'Created', 'Last Updated'])
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->teams->count() }}</td>
                    <td>{{ $department->created_at }}</td>
                    <td>{{ $department->updated_at }}</td>
                </tr>
            @endforeach
        @endcomponent
        {{ $departments->links() }}
    @endif
@endsection
