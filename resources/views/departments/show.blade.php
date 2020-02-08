@extends('layouts.app')

@section('title', $department->name)

@section('content')
    @component('components.department-navigation')
        @slot('departments', $departments)
    @endcomponent

    <div class="department-leader">
        @if(isset($department->leader) && $department->leader)
            @component('components.employee')
                @slot('employee', $department->leader)
                @slot('leader', true)
            @endcomponent
        @else
            @component('components.leader-placeholder')
                @slot('type', 'Department')
            @endcomponent
        @endif
    </div>

    <div class="org-chart-group org-chart-group-department">
        @foreach($department->teams as $team)
            @component('components.team')
                @slot('team', $team)
            @endcomponent
        @endforeach
    </div>
@endsection
