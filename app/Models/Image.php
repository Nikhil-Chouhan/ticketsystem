<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Tickets;

class Image extends Model
{
    use HasFactory;
    protected $table = 'image';
    public function tickets()
    {
        return $this->belongsTo(Tickets::class);
    }
}



