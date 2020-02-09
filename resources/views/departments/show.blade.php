@extends('layouts.app')

@section('title', $department->name)

@section('content')

    @component('components.department-navigation')
        @slot('departments', $departments)
    @endcomponent

    <div class="department">
        @component('components.employee')
            @slot('employee', $department->leader)
            @slot('leader', true)
        @endcomponent
    </div>

    <style>
        .department {
            max-width: 100vw;
        }
    </style>
@endsection
