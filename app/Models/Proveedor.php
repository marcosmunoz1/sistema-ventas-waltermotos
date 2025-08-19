<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //protected $fillable = ['nombre_proveedor'];
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre_proveedor',
        'cuit',
        'telefono',
        'celular',
        'email',
        'estado_proveedor'
    ];

    public function compras(){

        return $this->hasMany(Compra::class);
    }


}
