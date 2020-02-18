@if($departments->count() > 0)
    <div class="content has-text-centered">
        <label for="choose-department" class="sr-only">Department Selection</label>
        <div class="select">
            <select id="choose-department" oninput="navigateToDepartmentSelection()">
                <option value="">Select a Department</option>
                @foreach($departments as $department)
                    <option value="{{ route('departments.show', ['department' => $department->id]) }}"
                        {{ isset(Route::current()->parameters()['department']) && Route::current()->parameters()['department']->id === $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <script>
        function navigateToDepartmentSelection() {
            const select = document.getElementById('choose-department');
            const route = select.value;

            if (route) {
                window.location.href = route;
                select.parentNode.classList.add('is-loading');
            }
        }
    </script>
@endif
