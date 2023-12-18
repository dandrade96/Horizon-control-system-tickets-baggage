<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;

    protected $fillable = [
        'icao24',
        'airline_id'
    ];

    public function airline(){
        return $this->hasOne(Airline::class);
    }
}
