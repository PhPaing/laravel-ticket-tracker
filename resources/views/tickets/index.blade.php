@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-3">
        <h1 class="h3 mb-0">Support Tickets</h1>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">+ New Ticket</a>
    </div>

    <form method="GET" class="mb-3">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">All statuses</option>
            @foreach ($statuses as $s)
                <option value="{{ $s }}" @selected(request('status') === $s)>
                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                </option>
            @endforeach
        </select>
    </form>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->title }}</td>
                        <td>
                            <span class="badge text-bg-{{ ['low' => 'secondary', 'medium' => 'warning', 'high' => 'danger'][$ticket->priority] ?? 'secondary' }}">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </td>
                        <td>{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this ticket?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">No tickets yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $tickets->links() }}</div>
@endsection
