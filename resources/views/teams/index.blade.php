@extends('layouts.app')

@section('title', 'Teams')

@section('content')
    <p class="content has-text-centered">Teams are where employees are grouped.</p>
    @if($teams->count())
        @component('components.table')
            @slot('headers', ['ID', 'Name', 'Department', 'Employees', 'Created', 'Last Updated'])
            @foreach($teams as $team)
                <tr>
                    <td>{{ $team->id }}</td>
                    <td>{{ $team->name }}</td>
                    <td>{{ $team->department->name }}</td>
                    <td>{{ $team->employees->count() }}</td>
                    <td>{{ $team->created_at }}</td>
                    <td>{{ $team->updated_at }}</td>
                </tr>
            @endforeach
        @endcomponent
        {{ $teams->links() }}
    @endif
@endsection
