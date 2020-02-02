@extends('layouts.app')

@section('title', 'Employees')

@section('content')
    <div class="column">
        <p class="content has-text-centered">Employees make your institution function.</p>
        @if($employees->count())
            @component('components.table')
                @slot('headers', ['ID', 'Name', 'Title', 'Team', 'Created', 'Last Updated'])
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->title }}</td>
                        <td>{{ $employee->team->name }}</td>
                        <td>{{ $employee->created_at }}</td>
                        <td>{{ $employee->updated_at }}</td>
                    </tr>
                @endforeach
            @endcomponent
            {{ $employees->links() }}
        @endif
    </div>
@endsection
