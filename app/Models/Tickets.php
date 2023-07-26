<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Tickets extends Model
{
    use HasFactory;
    protected $table='tickets';
    protected $fillable = ['escalate'];
    
    public function image() 
    {
        return $this->hasMany(Image::class);
    }
}
