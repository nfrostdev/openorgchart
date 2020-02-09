<div class="employee  {{ $employee->team->count() > 0 ? 'supervisor' : '' }}">
    <div class="box has-text-centered employee-box {{ isset($leader) && $leader ? 'leader' : '' }} {{ $employee->team->count() > 0 ? 'supervisor' : '' }}">
        <div class="has-text-weight-semibold {{ $employee->team->count() > 0 ? 'has-text-link' : '' }} employee-box-name">
            {{ $employee->first_name }} {{ $employee->last_name }}
        </div>
        <div class="employee-box-title is-size-7">{{ $employee->title }}</div>
    </div>

    @if($employee->team->count() > 0)
        <div class="team @if(!isset($leader) || !$leader) team-{{$employee->id}}-nested @endif">
            @foreach($employee->team->sortBy('first_name')->sortBy('title') as $team_employee)
                @component('components.employee')
                    @slot('employee', $team_employee)
                @endcomponent
            @endforeach
        </div>
    @endif
</div>

<style>
    .employee {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .employee.supervisor {
        width: 100%;
        margin-top: 3rem;
    }

    .employee-box.supervisor {
        transform: scale(1.125);
    }

    .employee-box.leader {
        transform: scale(1.375);
    }

    .employee-box-name {
        line-height: 100%;
    }

    .employee-box-title {
        line-height: 100%;
        margin-top: 0.25rem;
    }

    .employee .box {
        margin: 1rem 0.5rem 0;
    }

    .team {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: start;
    }

    {{--.team-{{$employee->id}}-nested {--}}
    {{--    grid-template-columns: repeat({{ $employee->team->count() ?? '1' }}, 1fr);--}}
    {{--}--}}
</style>
