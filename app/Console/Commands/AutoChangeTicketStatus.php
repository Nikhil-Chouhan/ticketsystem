<?php

namespace App\Console\Commands;

use App\Models\Tickets; 

use Illuminate\Console\Command;
use Carbon\Carbon;

class AutoChangeTicketStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-change-ticket-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically change the status of unassigned tickets after 2 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twoHoursAgo = Carbon::now()->subMinutes(2);
        $fourHoursAgo=Carbon::now()->subMinutes(4);

        //Two Hours
        $unassignedTickets = Tickets::where('isLive', 0)
            ->where('created_at', '<=', $twoHoursAgo)
            ->get();

        foreach ($unassignedTickets as $ticket) {
            $ticket->update(['escalate' => 1]);
        }
        
        //Four Hours
        $unassignedTickets_pending = Tickets::where('isLive', 0)
            ->where('created_at', '<=', $fourHoursAgo)
            ->get();

        foreach ($unassignedTickets_pending as $ticket) {
            $ticket->update(['escalate' => 2]);
        }

    }
}
