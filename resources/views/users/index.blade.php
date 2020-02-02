@extends('layouts.app')

@section('title', 'Users')

@section('content')
    @if($users->count())
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Created</th>
                <th>Last Updated</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
