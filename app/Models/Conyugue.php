<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conyugue extends Model
{
    protected $fillable = [
        'apellido_conyugue',
        'nombre_conyugue',
        'dni_conyugue',
        'fecha_nacimiento_conyugue',
        'celular_conyugue',
        'id_conyugue_cliente' 
    ];

    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_conyugue_cliente'); 
    }
}

