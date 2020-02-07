<div class="box has-text-centered has-background-grey-lighter org-chart-employee leader">
    <div class="has-text-weight-semibold">Unoccupied</div>
    <div class="has-text-weight-light">{{ $type }} Leader</div>
    @if(isset($team_name))
        <div class="is-size-7">{{ $team_name }}</div>
    @endif
</div>
