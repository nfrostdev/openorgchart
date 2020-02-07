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
            <h2 class="subtitle is-4 has-text-centered">{{ $team->name }}</h2>
            @if(isset($team->leader) && $team->leader)
                @component('components.employee')
                    @slot('employee', $team->leader)
                    @slot('leader', true)
                @endcomponent
            @else
                @component('components.leader-placeholder')
                    @slot('type', 'Team')
                @endcomponent
            @endif

            <div class="org-chart-group">
                @if(isset($team->employees) && $team->employees->count() > 0)
                    @foreach($team->employees as $employee)
                        @component('components.employee')
                            @slot('employee', $employee)
                        @endcomponent
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>

    <style>
        .org-chart-group {
            display: grid;
            align-items: start;
            grid-gap: 0 1.5rem;
            padding: 1.5rem 0.5rem 4rem;
            overflow: hidden;
            grid-template-columns: repeat(2, 1fr);
        }

        .org-chart-group .box {
            margin: 0 0 1.5rem !important;
        }

        .org-chart-group-department {
            grid-template-columns: 1fr;
            max-width: 100vw;
            overflow: auto;
        }

        .department-leader {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 125%;
            margin-bottom: 3rem;
        }

        .org-chart-employee {
            position: relative;
            display: inline-flex !important;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .org-chart-employee.leader {
            z-index: 10;
            justify-self: center;
            margin-bottom: 0 !important;
        }

        .org-chart-employee-pointer {
            position: absolute;
            display: inline-flex;
            width: 0.813rem;
            background-color: #3273dc;
            height: 0.125rem;
            pointer-events: none;
        }

        .org-chart-employee-pointer__top {
            top: -150%;
            height: 200%;
            width: 0.125rem;
            z-index: -1;
        }

        .org-chart-employee:nth-child(odd):not(.leader) {
            justify-self: end;
        }

        .org-chart-employee:nth-child(even):not(.leader) {
            justify-self: start;
        }

        .org-chart-employee:nth-child(odd) .org-chart-employee-pointer,
        .org-chart-employee:nth-child(odd) .org-chart-employee-pointer__top {
            right: -0.813rem;
        }

        .org-chart-employee:nth-child(even) .org-chart-employee-pointer,
        .org-chart-employee:nth-child(even) .org-chart-employee-pointer__top {
            left: -0.813rem;
        }
    </style>
@endsection
