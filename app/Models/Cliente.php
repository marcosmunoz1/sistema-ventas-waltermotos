<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    protected $fillable = [
        'nombre_conyugue',
        'apellido_conyugue',
        'dni_conyugue',
        'fecha_nacimiento_conyugue',
        'celular_conyugue',
        'id_conyugue_cliente' // Asegúrate de tener esta columna en el fillable
    ];

    public function conyugue()
    {
        return $this->belongsTo(Conyugue::class, 'id_conyugue_cliente');
    }
}
