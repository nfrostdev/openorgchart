<div class="employee  {{ $employee->team->count() > 0 ? 'supervisor' : '' }}">
    <div class="box has-text-centered employee-box {{ isset($leader) && $leader ? 'leader' : '' }} {{ $employee->team->count() > 0 ? 'supervisor' : '' }}">
        @if($employee->supervisor && $employee->team->count() > 0)
            <div class="employee-box-reports-to has-text-gray-light" title="Reports to {{ $employee->supervisor->first_name }} {{ $employee->supervisor->last_name }}">
                <span class="fas fa-arrow-up"></span>
                <span class="employee-box-reports-to-text">{{ $employee->supervisor->first_name }} {{ $employee->supervisor->last_name }}</span>
            </div>
        @endif
        <div class="has-text-weight-semibold {{ $employee->team->count() > 0 ? 'has-text-link' : '' }} employee-box-name">
            {{ $employee->first_name }} {{ $employee->last_name }}
        </div>
        <div class="employee-box-title is-size-7">{{ $employee->title }}</div>
    </div>

    @if($employee->team->count() > 0)
        <div class="team">
            @foreach($employee->team->sortBy('first_name')->sortBy('title') as $team_employee)
                @component('components.employee')
                    @slot('employee', $team_employee)
                @endcomponent
            @endforeach
        </div>
    @endif
</div>
