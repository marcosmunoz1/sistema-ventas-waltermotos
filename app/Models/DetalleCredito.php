<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCredito extends Model
{
    //
    protected $table = 'detalles_creditos';

    public function detalle_credito()
    {
        return $this->hasMany(DetalleCredito::class, 'id_credito');
    }
}
