@extends('layouts.app')

@section('title', 'Organizational Chart')

@section('content')
    <h2 class="has-text-centered title is-3">{{ $department->name }}</h2>

    @if(isset($department->leader) && $department->leader)
        @component('components.employee')
            @slot('employee', $department->leader)
            @slot('leader', true)
        @endcomponent
    @endif

    <div class="org-chart-group org-chart-group-department">
        @foreach($department->teams as $team)
            @if(isset($team->leader) && $team->leader)
                @component('components.employee')
                    @slot('employee', $team->leader)
                    @slot('team_name', $team->name)
                @endcomponent
            @endif
        @endforeach

        @foreach($department->teams as $team)
            <div class="org-chart-group org-chart-group-{{ $team->id }}-team">
                @if(isset($team->employees) && $team->employees->count() > 0)
                    @foreach($team->employees as $employee)
                        @component('components.employee')
                            @slot('employee', $employee)
                        @endcomponent
                    @endforeach
                @endif
                <style>
                    .org-chart-group-{{ $team->id }}-team {
                        grid-template-columns: repeat({{ $team->employees->count() }}, 1fr);
                    }
                </style>
            </div>
        @endforeach

        <style>
            .org-chart-group-department {
                grid-template-columns: repeat({{ $department->teams->count() }}, 1fr);
            }
        </style>
    </div>
@endsection

<style>
    .org-chart-employee {
        position: relative;
        display: flex !important;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .org-chart-employee-pointer {
        position: absolute;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        top: -1.5rem;
        height: 1.5rem;
        background-color: #77F;
        width: 0.125rem;
        pointer-events: none;
    }

    .org-chart-group {
        display: grid;
        grid-gap: 0 1.5rem;
    }
</style>
