<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Ticket::class);

        $user = Auth::user();
        if ($user->is_admin) {
            $tickets = Ticket::all();
        } else {
            $tickets = $user->tickets;

        }

        return TicketResource::collection($tickets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        Gate::authorize('create', Ticket::class);

        $validated = $request->validated();
        $ticket = $request->user()->tickets()->make($validated);

        if (isset($validated['categories'])) {
            $ticket->categories()->attach($validated['categories']);
        }

        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        Gate::authorize('view', $ticket);

        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        Gate::authorize('update', $ticket);

        $validated = $request->validated();
        $ticket->fill($validated);

        if (Auth::user()->is_admin) {
            $ticket->status = $validated['status'];
        }

        $ticket->save();

        if (isset($validated['categories'])) {
            $ticket->categories()->sync($validated['categories']);
        } else {
            $ticket->categories()->detach();

        }

        return new TicketResource($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        Gate::authorize('delete', $ticket);

        $ticket->delete();

        return response()->json(null, 204);
    }
}
