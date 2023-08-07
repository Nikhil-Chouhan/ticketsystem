<?php

namespace App\Listeners;

use App\Events\NewTicketRaised;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewTicketRaisedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewTicketRaised $event): void
    {
        
    }
}
