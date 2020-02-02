@extends('layouts.app')

@section('title', 'Users')

@section('content')
    @if($users->count())
        <div class="column">
            @component('components.table')
                @slot('headers', ['ID', 'Name', 'E-mail', 'Created', 'Last Updated'])
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                @endforeach
            @endcomponent
            {{ $users->links() }}
        </div>
    @endif
@endsection
