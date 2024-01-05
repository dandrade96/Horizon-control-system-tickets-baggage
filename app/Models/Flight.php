<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'origin_airport_id',
        'destination_airport_id',
        'departure_datetime',
        'arrival_datetime',
        'airplane_id'
    ];

    public function origin(){
        return $this->belongsTo(Airport::class, 'origin_airport_id', 'id');
    }

    public function destination(){
        return $this->belongsTo(Airport::class, 'destination_airport_id', 'id');
    }

    public function airplane(){
        return $this->belongsTo(Airplane::class, 'airplane_id', 'id');
    }

}
