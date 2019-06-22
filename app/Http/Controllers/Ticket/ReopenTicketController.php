<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Services\TicketService;
use App\Http\Controllers\Controller;
use App\Services\Ticket\TicketActionService;
use App\Http\Requests\TicketRequest\TicketReopenRequest;

class ReopenTicketController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, TicketService $service, $id)
    {
        $ticket = $service->find($id);

        return view('ticket.reopen', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(TicketReopenRequest $request, TicketActionService $service, $id)
    {
        $service->reopen($request->all(), $id);
        
        return redirect()
            ->route('ticket.show', $id)
            ->with('notification', [
                'title' => 'Success!',
                'type' => 'success',
                'message' => 'The ticket has been reopened successfully',
            ]);
    }
}
