<div class="box has-text-centered org-chart-employee {{ isset($leader) ? 'leader' : '' }}">
    @if(!isset($leader))
        <div class="org-chart-employee-pointer" aria-hidden="true"></div>
        <div class="org-chart-employee-pointer org-chart-employee-pointer__top" aria-hidden="true"></div>
    @endif
    <div class="has-text-weight-semibold">{{ $employee->first_name }} {{ $employee->last_name }}</div>
    <div class="has-text-weight-light">{{ $employee->title }}</div>
    @if(isset($team_name))
        <div class="is-size-7">{{ $team_name }}</div>
    @endif
</div>
