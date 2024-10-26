<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nombre', 'direccion', 'telefono', 'email', 'website',
        'nombre_propietario', 'direccion_propietario', 'telefono_propietario', 
        'status', 
    ];

    // Relación con archivos
    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
