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
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
    }

    public function flightClasses(){
        return $this->hasMany(FlightClass::class, 'airplane_id', 'id');
    }

    public function flight(){
        return $this->hasMany(Flight::class, 'airplane_id', 'id');
    }
}
