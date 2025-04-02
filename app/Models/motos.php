<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class motos extends Model
{
    public function nacionalidad(){
        return $this->belongsTo(Nacionalidades::class);
    }
    public function compra(){
        return $this->belongsTo(Compras::class);
    }
    public function marca(){
        return $this->belongsTo(Marcas::class);
    }
    public function deposito(){
        return $this->belongsTo(Depositos::class);
    }

} 
