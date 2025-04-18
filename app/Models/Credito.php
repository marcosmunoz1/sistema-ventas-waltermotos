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
}
