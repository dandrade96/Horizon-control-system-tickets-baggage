<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_name',
        'buyer_cpf',
        'buyer_birthday',
        'buyer_email',
        'quantity_tickets',
        'created_at',
        'updated_at'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
