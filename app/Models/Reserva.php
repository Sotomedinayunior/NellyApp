<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'nombre', 'email', 'landing_id', 'vehiculo_id'
    ];
    public function landing()
    {
        return $this->belongsTo(Landings::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    use HasFactory;
}