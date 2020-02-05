@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <p class="has-text-centered content">Select a Department.</p>
    @component('components.department-navigation')
        @slot('departments', $departments)
    @endcomponent
@endsection
