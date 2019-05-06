<?php

namespace App\Jobs\Ticket;

use Illuminate\Bus\Queueable;
use App\Models\Ticket\Ticket;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Ticket\Activity\CreateActivity;

class CloseTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ticket, $id)
    {
        $this->ticket = $ticket;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update([ 'status' => Ticket::resolvedStatus() ]);

        $this->dispatch(new CreateActivity([
            'title' => 'Ticket ' . $ticket->code . ' closed by ' . Auth::user()->full_name,
            'details' => $this->ticket['details'],
        ], $this->id));
    }
}