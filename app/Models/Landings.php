<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landings extends Model
{
    protected $fillable = [
        'nombre', 'logo', 'primary_color', 'secondary_color', 'user_id'
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
    use HasFactory;
}