@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @component('components.department-navigation')
        @slot('departments', $departments)
    @endcomponent
@endsection
