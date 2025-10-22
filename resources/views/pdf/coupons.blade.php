<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Discount percentage</th>
            <th>Expiration date</th>
            <th>Points cost</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->name }}</td>
                <td>{{ $record->discount_percentage }}</td>
                <td>{{ $record->expiration_date }}</td>
                <td>{{ $record->points_cost }}</td>
                <td>{{ $record->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
