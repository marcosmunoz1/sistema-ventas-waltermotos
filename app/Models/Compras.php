<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    public function proveedor(){
        return $this->belongsTo(Proveedores::class);
    }
}
