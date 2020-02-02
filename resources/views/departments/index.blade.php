@extends('layouts.app')

@section('title', 'Departments')

@section('content')
    <div class="column">
        <p class="content has-text-centered">Departments are the broadest level of organization for your institution.</p>
        @if($departments->count())
            @component('components.table')
                @slot('headers', ['ID', 'Name', 'Created', 'Last Updated'])
                @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->created_at }}</td>
                        <td>{{ $department->updated_at }}</td>
                    </tr>
                @endforeach
            @endcomponent
            {{ $departments->links() }}
        @endif
    </div>
@endsection
