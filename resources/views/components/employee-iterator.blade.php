<div class="is-inline-block">
    @component('components.employee')
        @slot('employee', $employee)
        @if(isset($leader))
            @slot('leader', $leader)
        @endif
    @endcomponent

    @if($employee->employees->count() > 0)
        <div class="org-chart-group org-chart-group-{{ $employee->id }}">
            @foreach($employee->employees as $worker)
                @component('components.employee-iterator')
                    @slot('employee', $worker)
                @endcomponent
            @endforeach
        </div>

        <style>
            .org-chart-group-{{ $employee->id }}    {
                grid-template-columns: repeat({{ $employee->employees->count() }}, 1fr);
            }
        </style>
    @endif
</div>
