@extends('layouts.app')

@section('title', $department->name)

@section('content')

    @component('components.department-navigation')
        @slot('departments', $departments)
    @endcomponent

    <div class="department">
        @component('components.employee')
            @slot('employee', $department->leader)
            @slot('leader', true)
        @endcomponent
    </div>

    <script>
        function highlightSupervisor(id) {
            const supervisor = document.getElementById(id).querySelector('.employee-box');
            let timeoutCount = 0;

            for (let i = 0; i < 4; i++) {
                timeoutCount += 300;
                setTimeout(function () {
                    supervisor.classList.toggle('highlighted');
                }, timeoutCount);
            }
        }
    </script>
@endsection
