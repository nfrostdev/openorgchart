@extends('layouts.app')

@section('title', 'Organizational Chart')

@section('content')
    <h2 class="has-text-centered title is-3">{{ $department->name }}</h2>

    @if(isset($department->leader) && $department->leader)
        <div class="org-chart-team">
            <h3 class="has-text-centered title is-4">{{ $department->name }} Overview</h3>
            @component('components.employee-iterator')
                @slot('employee', $department->leader)
                @slot('leader', true)
            @endcomponent
        </div>
    @endif

    <h2 class="has-text-centered title is-3">{{ $department->name }} Teams</h2>
    @foreach($department->teams as $team)
        @if(isset($team->leader) && $team->leader)
            <div class="org-chart-team">
                <h3 class="has-text-centered title is-4">{{ $team->name }}</h3>
                @component('components.employee-iterator')
                    @slot('employee', $team->leader)
                    @slot('leader', true)
                @endcomponent
            </div>
        @endif
    @endforeach
@endsection

<style>
    .department-leader {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .org-chart-team {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        max-width: 100%;
        margin-top: 3rem;
    }

    .org-chart-employee {
        position: relative;
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
        align-items: start;
        align-content: center;
        justify-items: center;
        justify-content: center;
        grid-gap: 0.5rem;
    }
</style>
