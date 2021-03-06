<?php

namespace App\Http\Controllers\Ticket;

use App\Models\Ticket\Tag;
use App\Models\Ticket\Level;
use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\Category;
use App\Services\TicketService;
use App\Services\Ticket\TagService;
use App\Http\Controllers\Controller;
use App\Services\Ticket\ActivityService;
use App\Services\Ticket\TicketActionService;
use App\Http\Requests\TicketRequest\TicketStoreRequest;
use App\Http\Requests\TicketRequest\TicketUpdateRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $status = Ticket::pluck('status')->unique();
        $levels = Level::all();

        return view('ticket.index')
                    ->with('categories', $categories)
                    ->with('status', $status)
                    ->with('levels', $levels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TagService $service)
    {
        $levels = Level::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name')->toArray();
        $tags_string = $service->join($tags);

        return view('ticket.create')
            ->with('levels', $levels)
            ->with('tags', $tags)
            ->with('tags_string', $tags_string)
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketStoreRequest $request, TicketActionService $service)
    {
        $service->initialize($request->all());

        return redirect()
            ->route('ticket.index')
            ->with('notification', [
                'title' => 'Success',
                'type' => 'success',
                'message' => 'You have successfully created a ticket'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TicketService $service, ActivityService $activity, $id)
    {
        $ticket = $service->find($id);
        $isVerified = $activity->verifiedCount($ticket);
        $isAssigned = $ticket->assigned_to ?? false;
        $isClosed = $ticket->isClosed();
        $tags = $ticket->tags;

        return view('ticket.show', compact(
            'ticket', 
            'tags',
            'isVerified',
            'isClosed',
            'isAssigned',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketService $service, $id)
    {
        $ticket = $service->find($id);

        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketUpdateRequest $request, TicketActionService $service, $id)
    {
        $service->update($request->all(), $id);
        
        return redirect()
            ->route('ticket.index')
            ->with('notification', [
                'title' => 'Success',
                'type' => 'success',
                'message' => 'You have successfully updated a ticket'
            ]);
    }
}
