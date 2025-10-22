<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Points value</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->name }}</td>
                <td>{{ $record->type }}</td>
                <td>{{ $record->price }}</td>
                <td>{{ $record->points_value }}</td>
                <td>{{ $record->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
