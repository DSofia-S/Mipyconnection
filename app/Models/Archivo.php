<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id', 'nombre_archivo', 'ruta_archivo',
    ];

    // Relación con empresas
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
