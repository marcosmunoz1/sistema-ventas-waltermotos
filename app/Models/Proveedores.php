<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    //protected $fillable = ['nombre_proveedor'];

    public function compras(){

        return $this->hasMany(Compra::class);
    }


}


