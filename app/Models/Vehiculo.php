<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Landings;

class Vehiculo extends Model
{
     protected $fillable = [
        'name', 'image' , 'descripcion', 'precio', 'equipaje', 'capacidad', 'tipo', 'transmision', 'bluetooth', 'siriusX', 'GpS', 'apple_cars', 'landing_id'
    ];
    public function landing()
    {
        return $this->belongsTo(Landings::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
    use HasFactory;
}