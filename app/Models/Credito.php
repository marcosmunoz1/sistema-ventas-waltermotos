<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    //
    public function detalles()
    {
        return $this->hasMany(DetalleCredito::class, 'id_credito');
    }

    public function venta(){
        return $this->belongsTo(Venta::class, 'id_venta');
    }
}
