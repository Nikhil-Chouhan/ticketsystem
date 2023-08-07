<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Image;
use app\Models\ExcelFile;
class Tickets extends Model
{
    use HasFactory;
    protected $table='tickets';
    protected $fillable = ['escalate'];
    
 
    public function image() 
    {
        return $this->hasMany(Image::class);
    }

    public function excel() 
    {
        return $this->hasMany(ExcelFile::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Define the 'created' model event
        static::created(function ($ticket) {
            // Trigger the JavaScript toastr event
            \Log::info('Dispatching browser event for new ticket: ' . $ticket->id);
            event(new \App\Events\NewTicketRaised($ticket));
        });
    }
}
