<div class="employee">
    <div class="box has-text-centered employee-box is-size-7">
        <div class="has-text-weight-semibold is-size-6 employee-box-name">{{ $employee->first_name }} {{ $employee->last_name }}</div>
        <div class="employee-box-title">{{ $employee->title }}</div>
        @if($employee->supervisor)
            <div class="has-text-weight-light employee-box-reports-to" title="Reports to {{ $employee->supervisor->first_name ?? 'No Supervisor' }} {{ $employee->supervisor->last_name ?? '' }}">
                <span class="fas fa-user-check"></span>
                <span class="employee-box-reports-to-text">{{ $employee->supervisor->first_name }} {{ $employee->supervisor->last_name }}</span>
            </div>
        @endif
    </div>

    @if($employee->team->count() > 0)
        <div class="team team-{{$employee->id}}-nested">
            @foreach($employee->team->sortBy('title') as $team_employee)
                @component('components.employee')
                    @slot('employee', $team_employee)
                @endcomponent
            @endforeach
        </div>
    @endif
</div>

@php
    $nesting = false;

    foreach($employee->team as $team_employee) {
        if($team_employee->team->count() > 0) {
            $nesting = true;
        }
    }
@endphp

<style>
    .employee {
        display: flex;
        justify-content: start;
        align-items: center;
        flex-direction: column;
    }

    .employee-box-name {
        line-height: 100%;
    }

    .employee-box-title {
        line-height: 100%;
        margin-top: 0.5rem;
    }

    .employee-box-reports-to {
        line-height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 0.5rem;
    }

    .employee-box-reports-to-text {
        margin-left: 0.25rem;
    }

    .employee .box {
        margin: 1rem 0 0;
    }

    .team {
        display: grid;
        justify-content: center;
        justify-items: center;
        grid-gap: 0 1rem;
    }

    @if($nesting)
    .team-{{$employee->id}}-nested {
        grid-template-columns: repeat({{ $employee->team->count() ?? '1' }}, 1fr);
    }

    @else
    .team-{{$employee->id}}-nested {
        grid-template-columns: repeat(1, 1fr);
    }
    @endif
</style>
