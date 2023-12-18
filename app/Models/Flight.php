<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_airport_id',
        'destination_airport_id',
        'departure_datetime',
        'arrival_datetime',
        'airplane_id'
    ];

    public function origin(){
        return $this->hasOne(Airport::class);
    }

    public function destination(){
        return $this->hasOne(Airport::class);
    }

    public function airplane(){
        return $this->hasOne(Airplane::class);
    }
}
