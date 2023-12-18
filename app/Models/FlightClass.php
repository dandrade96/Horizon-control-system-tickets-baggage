<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightClass extends Model
{
    use HasFactory;

    protected $table = 'flight_classes';

    protected $fillable = [
        'name',
        'seat_quantify',
        'seat_price',
        'airplane_id'
    ];

    public function airplane()
    {
        return $this->belongsTo(Airplane::class);
    }
}
