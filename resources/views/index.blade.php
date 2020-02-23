@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @if($departments->count() > 0)
        @component('components.department-navigation')
            @slot('departments', $departments)
        @endcomponent
    @else
        <p class="content has-text-centered">No Departments were found. Please come back later.</p>
    @endif
@endsection
