<div class="box has-text-centered org-chart-employee">
    @if(!isset($leader))
        <div class="org-chart-employee-pointer" aria-hidden="true"></div>
    @endif
    <div class="has-text-weight-semibold">{{ $employee->first_name }} {{ $employee->last_name }}</div>
    <div class="has-text-weight-light">{{ $employee->title }}</div>
</div>
