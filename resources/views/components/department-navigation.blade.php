@if($departments->count() > 0)
    <div class="content buttons is-centered">
        @foreach($departments as $department)
            <a href="{{ route('departments.show', ['department' => $department->id]) }}"
               class="button card {{ isset(Route::current()->parameters()['department']) && Route::current()->parameters()['department']->id === $department->id ? 'is-active is-link' : '' }}">{{ $department->name }}</a>
        @endforeach
    </div>
@endif
