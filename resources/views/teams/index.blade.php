@extends('layouts.app')

@section('title', 'Teams')

@section('content')
    <p class="content has-text-centered">Teams are where employees are grouped.</p>
    @component('components.create-button')
        @slot('route', route('teams.create'))
        @slot('text', 'New Team')
    @endcomponent
    @if($teams->count())
        @component('components.table')
            @slot('headers', ['ID', 'Name', 'Leader', 'Department', 'Employees', 'Created', 'Last Updated'])
            @foreach($teams as $team)
                <tr>
                    <td>{{ $team->id }}</td>
                    <td><a href="{{ route('teams.edit', ['team' => $team->id]) }}">{{ $team->name }}</a></td>
                    <td>{!! $team->leader->first_name ?? '<strong>No Team Leader</strong>' !!} {{ $team->leader->last_name ?? '' }}</td>
                    <td>{!! $team->department->name ?? '<strong>No Department</strong>' !!}</td>
                    <td>{{ $team->leader ? $team->employees->count() + 1 : $team->employees->count() }}</td>
                    <td>{{ $team->created_at }}</td>
                    <td>{{ $team->updated_at }}</td>
                </tr>
            @endforeach
        @endcomponent
        {{ $teams->links() }}
    @endif
@endsection
