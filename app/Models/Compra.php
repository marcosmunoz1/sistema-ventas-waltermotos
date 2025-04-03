<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public function proveedor(){
        return $this->belongsTo(Proveedores::class);
    }
}
