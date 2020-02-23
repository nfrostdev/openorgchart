@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <p class="content has-text-centered">Administrators can manage other users and content. Editors can only manage content.</p>
    @component('components.create-button')
        @slot('route', route('users.create'))
        @slot('text', 'New User')
    @endcomponent
    @if($users->count())
        @component('components.table')
            @slot('headers', ['ID', 'Name', 'E-mail', 'Role', 'Created', 'Last Updated'])
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('users.edit', ['user' => $user]) }}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name ?? 'User' }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endforeach
        @endcomponent
        {{ $users->links() }}
    @else
        <p class="content has-text-centered">No Users were found.</p>
    @endif
@endsection
