@if($departments->count() > 0)
    <div class="section columns is-centered">
        <div class="tabs card is-toggle">
            <ul>
                @foreach($departments as $department)
                    <li class="has-background-white {{ isset(Route::current()->parameters()['department']) && Route::current()->parameters()['department']->id === $department->id ? 'is-active' : '' }}">
                        <a href="{{ route('departments.show', ['department' => $department->id]) }}">{{ $department->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
