<table>
    <thead>
    <tr>
        <th>Ticket ID</th>
        <th>Contact Name</th>
        <th>Subject</th>
        <th>Channel</th>
        <th>Status</th>
        <th>Email</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->contact_name }}</td>
            <td>{{ $ticket->subject }}</td>
            <td>{{ $ticket->channel }}</td>
            <td>{{ $ticket->status }}</td>
            <td>{{ $ticket->email }}</td>
            <td>{{ $ticket->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
