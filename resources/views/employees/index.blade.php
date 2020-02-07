@extends('layouts.app')

@section('title', 'Employees')

@section('content')
    <p class="content has-text-centered">Employees make your institution function.</p>

    @component('components.create-button')
        @slot('route', route('employees.create'))
        @slot('text', 'New Employee')
    @endcomponent

    @if($employees->count())
        @component('components.table')
            @slot('headers', ['ID', 'Name', 'Title', 'Team', 'Created', 'Last Updated'])
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td><a href="{{ route('employees.edit', ['employee' => $employee->id]) }}">{{ $employee->first_name }} {{ $employee->last_name }}</a></td>
                    <td>{{ $employee->title }}</td>
                    <td>{!! $employee->team->name ?? '<strong>No Team</strong>' !!}</td>
                    <td>{{ $employee->created_at }}</td>
                    <td>{{ $employee->updated_at }}</td>
                </tr>
            @endforeach
        @endcomponent
        {{ $employees->links() }}
    @endif
@endsection
