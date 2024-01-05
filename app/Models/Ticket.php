<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_class_id',
        'flight_id',
        'passenger_name',
        'passenger_cpf',
        'passenger_birthday',
        'total_price',
        'number',
        'purchase_id'
    ];

    public function classes(){
        return $this->hasMany(FlightClass::class, 'id', 'flight_class_id');
    }

    public function baggages()
    {
        return $this->hasMany(Baggage::class);
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
