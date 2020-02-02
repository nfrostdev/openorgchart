@extends('layouts.app')

@section('title', 'Departments')

@section('content')
    @if($departments->count())
        <div class="column">
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
        </div>
    @endif
@endsection
