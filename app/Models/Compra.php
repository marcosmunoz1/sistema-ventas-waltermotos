<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    public function motos()
    {
        return $this->hasMany(Moto::class, 'id_compra');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca'); // <--- clave foránea
    }
}

