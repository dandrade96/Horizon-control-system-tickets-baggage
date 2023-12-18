<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_class_id',
        'passenger_name',
        'passenger_cpf',
        'passenger_birthday',
        'total_price',
        'purchase_id'
    ];

    public function classes(){
        return $this->hasMany(FlightClass::class);
    }

    public function baggages()
    {
        return $this->hasMany(Baggage::class);
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
