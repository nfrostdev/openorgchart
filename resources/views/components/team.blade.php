<h2 class="subtitle is-4 has-text-centered">{{ $team->name }}</h2>
@if(isset($team->leader) && $team->leader)
    @component('components.employee')
        @slot('employee', $team->leader)
        @slot('leader', true)
    @endcomponent
@else
    @component('components.leader-placeholder')
        @slot('type', 'Team')
    @endcomponent
@endif

<div class="org-chart-group">
    @if(isset($team->employees) && $team->employees->count() > 0)
        @foreach($team->employees as $employee)
            @component('components.employee')
                @slot('employee', $employee)
            @endcomponent
        @endforeach
    @endif
</div>
