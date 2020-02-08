<div class="employee">
    <div class="box has-text-centered employee-box is-size-7">
        <div class="has-text-weight-semibold is-size-6 employee-box-name">{{ $employee->first_name }} {{ $employee->last_name }}</div>
        <div class="employee-box-title">{{ $employee->title }}</div>
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

<style>
    .employee-box-name {
        line-height: 100%;
    }

    .employee-box-title {
        line-height: 100%;
        margin-top: 0.25rem;
    }

    .employee .box {
        margin: 1rem 0 0;
    }

    .team {
        display: grid;
        grid-gap: 0 1rem;
    }

    .team-{{$employee->id}}-nested {
        grid-template-columns: repeat({{ $employee->team->count() ?? '1' }}, 1fr);
    }
</style>
