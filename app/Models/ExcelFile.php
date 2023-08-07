<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Tickets;

class ExcelFile extends Model
{
    use HasFactory;
    protected $table ='excelfiles';
    
    public function tickets()
    {
        return $this->belongsTo(Tickets::class);
    }
}
