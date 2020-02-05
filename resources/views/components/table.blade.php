<div class="table-container box is-paddingless">
    <table class="table is-fullwidth is-striped is-hoverable">
        <thead>
        <tr>
            @foreach($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        {{ $slot }}
        </tbody>
    </table>
</div>
