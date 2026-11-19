<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    private const STATUSES = ['open', 'in_progress', 'resolved'];
    private const PRIORITIES = ['low', 'medium', 'high'];

    public function index(Request $request): View
    {
        $tickets = Ticket::query()
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('tickets.index', [
            'tickets' => $tickets,
            'statuses' => self::STATUSES,
        ]);
    }

    public function create(): View
    {
        return view('tickets.create', [
            'ticket' => new Ticket(['status' => 'open', 'priority' => 'medium']),
            'statuses' => self::STATUSES,
            'priorities' => self::PRIORITIES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Ticket::create($this->validated($request));

        return redirect()->route('tickets.index')->with('success', 'Ticket created.');
    }

    public function edit(Ticket $ticket): View
    {
        return view('tickets.edit', [
            'ticket' => $ticket,
            'statuses' => self::STATUSES,
            'priorities' => self::PRIORITIES,
        ]);
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        $ticket->update($this->validated($request));

        return redirect()->route('tickets.index')->with('success', 'Ticket updated.');
    }

    public function destroy(Ticket $ticket): RedirectResponse
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:' . implode(',', self::STATUSES)],
            'priority' => ['required', 'in:' . implode(',', self::PRIORITIES)],
        ]);
    }
}
